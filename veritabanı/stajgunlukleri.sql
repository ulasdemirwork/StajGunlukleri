-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 20 May 2024, 20:49:21
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `stajgunlukleri`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `kullanici_id` int(11) NOT NULL,
  `kullanici_isim` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_soyad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_email` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_sifre` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_tur` enum('1','2','3') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1',
  `kullanici_telefon` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_resim` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `unuttum_kod` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`kullanici_id`, `kullanici_isim`, `kullanici_soyad`, `kullanici_email`, `kullanici_sifre`, `kullanici_tur`, `kullanici_telefon`, `kullanici_resim`, `unuttum_kod`) VALUES
(54, 'aaa', 'ddd', 'ulsd@gmail.com', '$2y$10$gn1mHgf216Ep61/EgOcpeu0r6zfxOezlwtgBHS1NKTWHIbGjfakie', '1', '', '', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sirket_bilgileri`
--

CREATE TABLE `sirket_bilgileri` (
  `sirket_id` int(11) NOT NULL,
  `sirket_isim` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sirket_adres` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sirket_telefon` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sirket_unvan` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sirket_vizyon` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sirket_misyon` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sirket_aciklama` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sirket_resimyol` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sirket_email` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sirket_kullanici_email` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sirket_konum` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sirket_puani` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sirket_puan`
--

CREATE TABLE `sirket_puan` (
  `sirket_puan_id` int(11) NOT NULL,
  `sirket_ilan_id` int(11) NOT NULL,
  `sirket_kullanici_id` int(11) NOT NULL,
  `puan` int(11) NOT NULL,
  `sirket_puan_email` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sirket_yorumlar`
--

CREATE TABLE `sirket_yorumlar` (
  `sirket_yorum_id` int(11) NOT NULL,
  `sirket_kullanici_id` int(11) NOT NULL,
  `sirket_yorum_detay` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sirket_ilan_id` int(11) NOT NULL,
  `sirket_yorum_isim` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sirket_yorum_resim` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sirket_yorum_email` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stajyer_bilgileri`
--

CREATE TABLE `stajyer_bilgileri` (
  `stajyer_id` int(11) NOT NULL,
  `stajyer_isim` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `stajyer_soyisim` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `stajyer_yetenekler` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `stajyer_egitim_lise` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `stajyer_egitim_universite` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `stajyer_resimyol` varchar(300) COLLATE utf8_turkish_ci NOT NULL,
  `stajyer_telefon` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `stajyer_email` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stajyer_yorumlar`
--

CREATE TABLE `stajyer_yorumlar` (
  `stajyer_yorum_id` int(11) NOT NULL,
  `stajyer_kullanici_id` int(11) NOT NULL,
  `stajyer_yorum_detay` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `stajyer_cv_id` int(11) NOT NULL,
  `stajyer_yorum_isim` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `stajyer_yorum_resim` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `stajyer_yorum_email` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`kullanici_id`);

--
-- Tablo için indeksler `sirket_bilgileri`
--
ALTER TABLE `sirket_bilgileri`
  ADD PRIMARY KEY (`sirket_id`);

--
-- Tablo için indeksler `sirket_puan`
--
ALTER TABLE `sirket_puan`
  ADD PRIMARY KEY (`sirket_puan_id`);

--
-- Tablo için indeksler `sirket_yorumlar`
--
ALTER TABLE `sirket_yorumlar`
  ADD PRIMARY KEY (`sirket_yorum_id`);

--
-- Tablo için indeksler `stajyer_bilgileri`
--
ALTER TABLE `stajyer_bilgileri`
  ADD PRIMARY KEY (`stajyer_id`);

--
-- Tablo için indeksler `stajyer_yorumlar`
--
ALTER TABLE `stajyer_yorumlar`
  ADD PRIMARY KEY (`stajyer_yorum_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `kullanici_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Tablo için AUTO_INCREMENT değeri `sirket_bilgileri`
--
ALTER TABLE `sirket_bilgileri`
  MODIFY `sirket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `sirket_puan`
--
ALTER TABLE `sirket_puan`
  MODIFY `sirket_puan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Tablo için AUTO_INCREMENT değeri `sirket_yorumlar`
--
ALTER TABLE `sirket_yorumlar`
  MODIFY `sirket_yorum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Tablo için AUTO_INCREMENT değeri `stajyer_bilgileri`
--
ALTER TABLE `stajyer_bilgileri`
  MODIFY `stajyer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `stajyer_yorumlar`
--
ALTER TABLE `stajyer_yorumlar`
  MODIFY `stajyer_yorum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
