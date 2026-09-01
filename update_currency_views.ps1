$files = Get-ChildItem -Recurse -Path resources\views\frontend -Filter *.blade.php
foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw
    $originalContent = $content
    
    # Pattern 1: SAR {{ number_format($variable, 2) }}
    $content = $content -replace 'SAR \{\{\s*number_format\(([^,]+),\s*2\)\s*\}\}', '{{ format_price($1) }}'
    
    # Pattern 2: SAR {{ $variable }}
    $content = $content -replace 'SAR \{\{\s*([^}]+)\s*\}\}', '{{ format_price($1) }}'
    
    # Pattern 3: Old placeholder SAR 150.00 (static cases)
    # $content = $content -replace 'SAR\s*(\d+(\.\d+)?)', '{{ format_price($1) }}'

    if ($content -ne $originalContent) {
        $content | Set-Content $file.FullName -NoNewline
        Write-Host "Updated: $($file.FullName)"
    }
}
Write-Host "Currency display update complete."
