$files = Get-ChildItem -Recurse -Path resources\views -Filter *.blade.php
foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw
    if ($content -match "storage/app/public/") {
        $newContent = $content -replace "storage/app/public/", "storage/"
        $newContent | Set-Content $file.FullName -NoNewline
        Write-Host "Updated: $($file.FullName)"
    }
}
Write-Host "All blade files checked and updated where necessary."
