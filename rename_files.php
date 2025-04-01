<?php
// Dizini tanımla
$directory = 'public/storage/digitals';

// Dizindeki tüm dosyaları al
$files = scandir($directory);

foreach ($files as $file) {
    // Sadece normal dosyalarla ilgilen
    if (is_file($directory . '/' . $file)) {
        // Boşluk içeren dosya adlarını bul
        if (strpos($file, ' ') !== false) {
            // Boşlukları alt çizgi ile değiştir
            $newName = str_replace(' ', '_', $file);
            // Dosyayı yeniden adlandır
            rename($directory . '/' . $file, $directory . '/' . $newName);
            echo "Dosya yeniden adlandırıldı: $file -> $newName\n";
        }
    }
} 