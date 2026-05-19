param(
    [Parameter(Mandatory = $true)]
    [string]$ProjectDir,
    [string]$DbHost = "127.0.0.1",
    [int]$DbPort = 3306,
    [string]$DbDatabase = "careerforge",
    [string]$DbUsername = "root",
    [string]$DbPassword = "",
    [string]$PhpExe = "",
    [switch]$CopyUploads,
    [switch]$RunMigrations
)

Set-StrictMode -Version Latest
$ErrorActionPreference = "Stop"

function Copy-Dir([string]$Src, [string]$Dst) {
    if (-not (Test-Path $Src)) { return }
    if (-not (Test-Path $Dst)) { New-Item -ItemType Directory -Path $Dst | Out-Null }
    Copy-Item -Path (Join-Path $Src '*') -Destination $Dst -Recurse -Force
}

function Resolve-Php([string]$ExplicitPath) {
    if ($ExplicitPath -and $ExplicitPath.Trim().Length -gt 0) {
        if (-not (Test-Path $ExplicitPath)) {
            throw "'php' not found at '$ExplicitPath'. Provide a valid path (example: C:\\xampp\\php\\php.exe) or add PHP to PATH."
        }
        return (Resolve-Path $ExplicitPath).Path
    }

    $cmd = Get-Command php -ErrorAction SilentlyContinue
    if ($cmd) { return $cmd.Source }

    throw "Missing command 'php'. Install PHP and ensure it's in PATH, or pass -PhpExe 'C:\\path\\to\\php.exe' (common: C:\\xampp\\php\\php.exe)."
}

$repoRoot = Resolve-Path (Join-Path $PSScriptRoot "..\..")
$packRoot = Resolve-Path (Join-Path $PSScriptRoot "..")
$projectDirResolved = Resolve-Path $ProjectDir

Write-Host "Repo root: $repoRoot"
Write-Host "Conversion pack: $packRoot"
Write-Host "Laravel project dir: $projectDirResolved"

# routes
Copy-Item -Path (Join-Path $packRoot 'routes\web.php') -Destination (Join-Path $projectDirResolved 'routes\web.php') -Force

# controllers/models/views/assets
Copy-Dir (Join-Path $packRoot 'app\Http\Controllers\Student') (Join-Path $projectDirResolved 'app\Http\Controllers\Student')
Copy-Dir (Join-Path $packRoot 'app\Models') (Join-Path $projectDirResolved 'app\Models')
Copy-Dir (Join-Path $packRoot 'resources\views\student') (Join-Path $projectDirResolved 'resources\views\student')
Copy-Dir (Join-Path $packRoot 'public\assets') (Join-Path $projectDirResolved 'public\assets')

# images
$oldUserPng = Join-Path $repoRoot 'assets\user.png'
$oldHomepageJpg = Join-Path $repoRoot 'student\homepages.jpg'
if (Test-Path $oldUserPng) {
    Copy-Item $oldUserPng (Join-Path $projectDirResolved 'public\assets\user.png') -Force
}
if (Test-Path $oldHomepageJpg) {
    Copy-Item $oldHomepageJpg (Join-Path $projectDirResolved 'public\homepages.jpg') -Force
}

# migrations (Option B: skip students create)
$migrationsSrc = Join-Path $packRoot 'database\migrations'
$migrationsDst = Join-Path $projectDirResolved 'database\migrations'
if (-not (Test-Path $migrationsDst)) { New-Item -ItemType Directory -Path $migrationsDst | Out-Null }
Get-ChildItem -Path $migrationsSrc -Filter '*.php' | Where-Object {
    $_.Name -notlike '*create_students_table.php'
} | ForEach-Object {
    Copy-Item $_.FullName -Destination (Join-Path $migrationsDst $_.Name) -Force
}

# uploads
if ($CopyUploads) {
    $uploadsSrc = Join-Path $repoRoot 'uploads'
    $uploadsDst = Join-Path $projectDirResolved 'public\uploads'
    Copy-Dir $uploadsSrc $uploadsDst
}

# .env
$envPath = Join-Path $projectDirResolved '.env'
if (Test-Path $envPath) {
    $envText = Get-Content -Raw -Path $envPath

    function Set-EnvLine([string]$text, [string]$key, [string]$value) {
        $escapedKey = [regex]::Escape($key)
        $pattern = "(?m)^$escapedKey=.*$"
        if ($text -match $pattern) {
            return [regex]::Replace($text, $pattern, "$key=$value")
        }
        return ($text.TrimEnd() + "`n$key=$value`n")
    }

    $envText = Set-EnvLine $envText 'DB_CONNECTION' 'mysql'
    $envText = Set-EnvLine $envText 'DB_HOST' $DbHost
    $envText = Set-EnvLine $envText 'DB_PORT' "$DbPort"
    $envText = Set-EnvLine $envText 'DB_DATABASE' $DbDatabase
    $envText = Set-EnvLine $envText 'DB_USERNAME' $DbUsername
    $envText = Set-EnvLine $envText 'DB_PASSWORD' $DbPassword

    Set-Content -Path $envPath -Value $envText -Encoding UTF8
}

if ($RunMigrations) {
    $phpCmd = Resolve-Php $PhpExe
    Push-Location $projectDirResolved
    try {
        & $phpCmd artisan migrate
    } finally {
        Pop-Location
    }
}

Write-Host "Done." -ForegroundColor Green
