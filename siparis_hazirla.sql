-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 14 Haz 2022, 17:43:27
-- Sunucu sürümü: 10.4.24-MariaDB
-- PHP Sürümü: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `siparis_hazirla`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_kullanicilar`
--

CREATE TABLE `tbl_kullanicilar` (
  `kullanici_id` int(11) NOT NULL,
  `kullanici_adi` varchar(30) DEFAULT NULL,
  `kullanici_sifre` varchar(10) DEFAULT NULL,
  `kullanici_yetki` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `tbl_kullanicilar`
--

INSERT INTO `tbl_kullanicilar` (`kullanici_id`, `kullanici_adi`, `kullanici_sifre`, `kullanici_yetki`) VALUES
(2, 'Admin', '123456', 'Yönetici');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_siparisler`
--

CREATE TABLE `tbl_siparisler` (
  `siparisler_id` int(11) NOT NULL,
  `siparis_eden_departman` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `siparis_eden_personel` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `siparis_talep_tarihi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `tbl_siparisler`
--

INSERT INTO `tbl_siparisler` (`siparisler_id`, `siparis_eden_departman`, `siparis_eden_personel`, `siparis_talep_tarihi`) VALUES
(17, 'Bilgi İşlem', 'Kader Tosun', '2022-06-09');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_siparis_satirlar`
--

CREATE TABLE `tbl_siparis_satirlar` (
  `satirlar_id` int(11) NOT NULL,
  `siparis_id` int(11) DEFAULT NULL,
  `malzeme_kodu` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `malzeme_miktari` decimal(10,0) DEFAULT NULL,
  `malzeme_birimi` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `malzeme_aciklama` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `malzeme_tanimi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `tbl_siparis_satirlar`
--

INSERT INTO `tbl_siparis_satirlar` (`satirlar_id`, `siparis_id`, `malzeme_kodu`, `malzeme_miktari`, `malzeme_birimi`, `malzeme_aciklama`, `malzeme_tanimi`) VALUES
(78, 15, 'kod', '0', ' 77', '77çççççççççç', NULL),
(79, 16, 'MAKARA', '0', ' 77  çççççççç', '77çççççççççç', NULL),
(80, 17, 'JHJKFDLSK', '8', 'ADET', 'KFJLDŞFKJD', 'NN'),
(82, 17, 'kod', '7', ' 77', ' ll', 'tanim'),
(87, 17, '', '0', '', '', ''),
(88, 17, '', '0', '', '', ''),
(89, 17, '', '0', '', '', ''),
(91, 19, '', '0', '', '', ''),
(92, 19, '', '0', '', '', '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `tbl_kullanicilar`
--
ALTER TABLE `tbl_kullanicilar`
  ADD PRIMARY KEY (`kullanici_id`);

--
-- Tablo için indeksler `tbl_siparisler`
--
ALTER TABLE `tbl_siparisler`
  ADD PRIMARY KEY (`siparisler_id`);

--
-- Tablo için indeksler `tbl_siparis_satirlar`
--
ALTER TABLE `tbl_siparis_satirlar`
  ADD PRIMARY KEY (`satirlar_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `tbl_kullanicilar`
--
ALTER TABLE `tbl_kullanicilar`
  MODIFY `kullanici_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `tbl_siparisler`
--
ALTER TABLE `tbl_siparisler`
  MODIFY `siparisler_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `tbl_siparis_satirlar`
--
ALTER TABLE `tbl_siparis_satirlar`
  MODIFY `satirlar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
