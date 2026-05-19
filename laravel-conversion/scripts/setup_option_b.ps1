param(
    [string]$ProjectDir = (Join-Path $PSScriptRoot "..\..\careerforge-laravel"),
    [string]$DbHost = "127.0.0.1",
    [int]$DbPort = 3306,
    [string]$DbDatabase = "careerforge",
    [string]$DbUsername = "root",
    [string]$DbPassword = "",
    [string]$PhpExe = "",
    [string]$ComposerExe = "",
    [switch]$CopyUploads,
    [switch]$RunMigrations
)

Set-StrictMode -Version Latest
$ErrorActionPreference = "Stop"

function Resolve-CommandOrPath([string]$Name, [string]$ExplicitPath) {
    if ($ExplicitPath -and $ExplicitPath.Trim().Length -gt 0) {
        if (-not (Test-Path $ExplicitPath)) {
            throw "'$Name' not found at '$ExplicitPath'. Provide a valid path (example: C:\\xampp\\php\\php.exe) or add it to PATH."
        }
        return (Resolve-Path $ExplicitPath).Path
    }

    $cmd = Get-Command $Name -ErrorAction SilentlyContinue
    if ($cmd) {
        return $cmd.Source
    }

    if ($Name -eq 'php') {
        throw "Missing command 'php'. Install PHP and ensure it's in PATH, or pass -PhpExe 'C:\\path\\to\\php.exe' (common: C:\\xampp\\php\\php.exe)."
    }
    if ($Name -eq 'composer') {
        throw "Missing command 'composer'. Install Composer and ensure it's in PATH, or pass -ComposerExe 'C:\\path\\to\\composer.bat'."
    }
    throw "Missing command '$Name'. Install it and ensure it's in PATH."
}

function Copy-Dir([string]$Src, [string]$Dst) {
    if (-not (Test-Path $Src)) { return }
    if (-not (Test-Path $Dst)) { New-Item -ItemType Directory -Path $Dst | Out-Null }
    Copy-Item -Path (Join-Path $Src '*') -Destination $Dst -Recurse -Force
}

$repoRoot = Resolve-Path (Join-Path $PSScriptRoot "..\..")
$packRoot = Resolve-Path (Join-Path $PSScriptRoot "..")

Write-Host "Repo root: $repoRoot"
Write-Host "Conversion pack: $packRoot"
Write-Host "Laravel project dir: $ProjectDir"

$composerPath = Resolve-CommandOrPath "composer" $ComposerExe
$phpCmd = Resolve-CommandOrPath "php" $PhpExe

function Invoke-Composer([string[]]$ComposerArgs) {
    if ($composerPath.ToLower().EndsWith('.phar')) {
        & $phpCmd $composerPath @ComposerArgs
        if ($LASTEXITCODE -ne 0) {
            throw "Composer failed (php composer.phar). Exit code: $LASTEXITCODE"
        }
        return
    }
    & $composerPath @ComposerArgs
    if ($LASTEXITCODE -ne 0) {
        throw "Composer failed. Exit code: $LASTEXITCODE"
    }
}

if (-not (Test-Path $ProjectDir)) {
    Write-Host "Creating new Laravel project..." -ForegroundColor Cyan
    Invoke-Composer @('create-project','laravel/laravel',$ProjectDir)
}

$projectDirResolved = Resolve-Path $ProjectDir

# 1) Copy/replace routes
Write-Host "Copying routes/web.php..." -ForegroundColor Cyan
Copy-Item -Path (Join-Path $packRoot 'routes\web.php') -Destination (Join-Path $projectDirResolved 'routes\web.php') -Force

# 2) Controllers
Write-Host "Copying controllers..." -ForegroundColor Cyan
Copy-Dir (Join-Path $packRoot 'app\Http\Controllers\Student') (Join-Path $projectDirResolved 'app\Http\Controllers\Student')

# 3) Models
Write-Host "Copying models..." -ForegroundColor Cyan
Copy-Dir (Join-Path $packRoot 'app\Models') (Join-Path $projectDirResolved 'app\Models')

# 4) Views
Write-Host "Copying Blade views..." -ForegroundColor Cyan
Copy-Dir (Join-Path $packRoot 'resources\views\student') (Join-Path $projectDirResolved 'resources\views\student')

# 5) Public assets (CSS)
Write-Host "Copying public assets..." -ForegroundColor Cyan
Copy-Dir (Join-Path $packRoot 'public\assets') (Join-Path $projectDirResolved 'public\assets')

# 6) Copy images from the old PHP project into Laravel public/
Write-Host "Copying images..." -ForegroundColor Cyan
$oldUserPng = Join-Path $repoRoot 'assets\user.png'
$oldHomepageJpg = Join-Path $repoRoot 'student\homepages.jpg'
if (Test-Path $oldUserPng) {
    Copy-Item $oldUserPng (Join-Path $projectDirResolved 'public\assets\user.png') -Force
}
if (Test-Path $oldHomepageJpg) {
    Copy-Item $oldHomepageJpg (Join-Path $projectDirResolved 'public\homepages.jpg') -Force
}

# 7) Option B migrations: copy everything EXCEPT create_students_table
Write-Host "Copying migrations (Option B: skipping students create)..." -ForegroundColor Cyan
$migrationsSrc = Join-Path $packRoot 'database\migrations'
$migrationsDst = Join-Path $projectDirResolved 'database\migrations'
if (-not (Test-Path $migrationsDst)) { New-Item -ItemType Directory -Path $migrationsDst | Out-Null }
Get-ChildItem -Path $migrationsSrc -Filter '*.php' | Where-Object {
    $_.Name -notlike '*create_students_table.php'
} | ForEach-Object {
    Copy-Item $_.FullName -Destination (Join-Path $migrationsDst $_.Name) -Force
}

# 8) Optional uploads copy
if ($CopyUploads) {
    Write-Host "Copying uploads folder to public/uploads..." -ForegroundColor Cyan
    $uploadsSrc = Join-Path $repoRoot 'uploads'
    $uploadsDst = Join-Path $projectDirResolved 'public\uploads'
    Copy-Dir $uploadsSrc $uploadsDst
}

# 9) Update .env DB settings
Write-Host "Updating .env DB settings..." -ForegroundColor Cyan
$envPath = Join-Path $projectDirResolved '.env'
if (-not (Test-Path $envPath)) {
    throw ".env not found at $envPath"
}

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

# 10) Run migrations (optional)
if ($RunMigrations) {
    Write-Host "Running migrations..." -ForegroundColor Cyan
    Push-Location $projectDirResolved
    try {
        & $phpCmd artisan migrate
        if ($LASTEXITCODE -ne 0) {
            throw "Migrations failed. Check DB credentials in .env (DB_DATABASE/DB_USERNAME/DB_PASSWORD) and ensure MySQL is running. Exit code: $LASTEXITCODE"
        }
    } finally {
        Pop-Location
    }
}

Write-Host "Done." -ForegroundColor Green
Write-Host "Next: cd $projectDirResolved" -ForegroundColor Green
Write-Host "Then run: $phpCmd artisan serve" -ForegroundColor Green
