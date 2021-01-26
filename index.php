<?php
function HerseyiKopyala($kaynak, $hedef) {                  // HerseyiKopyala Fonksiyonunun içerisine kaynak ve hedef şeklinde iki değişken gönderiyoruz.
    if ( is_dir( $kaynak ) ) {                              // kaynak olarak belirtilen konum dizin olduğu doğrulunaıyor 
        if (!file_exists($hedef)) { @mkdir( $hedef ); }     // hedef dizin yoksa oluşturuyoruz
        $Dizin = dir( $kaynak );                            // kaynak dizinini açıyoruz
        while ( FALSE !== ( $giris = $Dizin->read() ) ) {    // dizin içerisini döngüye alıp tek tek okuyoruz
            if ( $giris == '.' || $giris == '..' ) {        // dizin konumlarını kontrol ediyoruz
                continue;
            }
            $Giris = $kaynak . '/' . $giris;                // gelen dizin konumunu değişkene atıyoruz
            if ( is_dir( $Giris ) ) {                       // Giris olarak belirtilen konum dizin olduğu doğrulunaıyor
                HerseyiKopyala( $Giris, $hedef . '/' . $giris ); // fonksiyonu yeniden çağırıyoruz
                continue;
            }
            copy( $Giris, $hedef . '/' . $giris );          // kontrol ettiğimiz dizine okuduğumuz dosyaları kopyalıyoruz
        }
        $Dizin->close();                                 // dizin okumayı sonlandırıyoruz
    }else {
        copy( $kaynak, $hedef );                            // belirtilen kaynak değişkeni dizin değilse kopyalama işlemini gerçekleştir
    }
}
$kaynak ='C:\xampp\mysql\data\global';                 //tüm klasörü kopyalama
date_default_timezone_set('Etc/GMT-3');
$date=date("d F Y, l H.i.s");

$hedef  ="C:\proje\'$date'";         //hedef dizini belirtiyoruz
 HerseyiKopyala($kaynak, $hedef);   //değişkenlerimizi fonksiyona gönderiyoruz

?>