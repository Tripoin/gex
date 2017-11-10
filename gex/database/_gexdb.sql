-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04 Nov 2017 pada 19.41
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `_gexdb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `customer_id` int(10) UNSIGNED NOT NULL,
  `jobsheet_id` int(10) UNSIGNED NOT NULL,
  `bank_id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `status` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `approval` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `type` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `efaktur` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `due_date` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `receipt_date` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `reason` text COLLATE utf8mb4_unicode_ci,
  `date_request` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_documents`
--

CREATE TABLE `invoice_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_ref` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobsheets`
--

CREATE TABLE `jobsheets` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `operation_id` int(10) UNSIGNED NOT NULL,
  `marketing_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `poo_id` int(10) UNSIGNED NOT NULL,
  `pod_id` int(10) UNSIGNED NOT NULL,
  `ref_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `etd` date DEFAULT NULL,
  `eta` date DEFAULT NULL,
  `vessel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partymeas` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `party_unit_id` int(10) UNSIGNED DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `instruction` text COLLATE utf8mb4_unicode_ci,
  `freight_type` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `step_role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `marketings`
--

CREATE TABLE `marketings` (
  `id` int(10) UNSIGNED NOT NULL,
  `jobsheet_id` int(10) UNSIGNED DEFAULT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_banks`
--

CREATE TABLE `master_banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cabang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atas_nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `swiftcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_banks`
--

INSERT INTO `master_banks` (`id`, `name`, `cabang`, `account`, `atas_nama`, `address`, `swiftcode`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 'CITIBANK', 'MANGGA DUA', '8006 881 515', 'PT. GLOBALINDO EXPRESS CARGO', '', 'CITIIDJX', NULL, '2017-11-05 01:38:52', '2017-11-05 01:38:52'),
(2, 'HSBC', 'SUDIRMAN', '050 – 054550 – 007', 'PT. GLOBALINDO EXPRESS CARGO', '', 'HSBCIDJA', NULL, '2017-11-05 01:38:52', '2017-11-05 01:38:52'),
(3, 'BCA', 'KCP PLUIT KENCANA', '244 3023 500', 'PT. GLOBALINDO EXPRESS CARGO', '', 'CENAIDJA', NULL, '2017-11-05 01:38:52', '2017-11-05 01:38:52'),
(4, 'DANAMON', 'PANGERAN JAYAKARTA', '0035 9231 0191', 'PT. GLOBALINDO EXPRESS CARGO', '', 'BDINIDJA', NULL, '2017-11-05 01:38:52', '2017-11-05 01:38:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_currencies`
--

CREATE TABLE `master_currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priceToIDR` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_customers`
--

CREATE TABLE `master_customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nick_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone1` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_customers`
--

INSERT INTO `master_customers` (`id`, `code`, `name`, `nick_name`, `address1`, `address2`, `city`, `province`, `country`, `phone1`, `phone2`, `fax`, `zipcode`, `type`, `created_at`, `updated_at`) VALUES
(1, 'CS00', 'GARRET FEIL', 'LILIANA50', '933 HERSHEL GLEN SUITE 206\nLIAMFURT, SD 54225-9750', '176 HUELS ESTATE\nLITTLEPORT, SD 90236', 'GAYLORDMOUTH', 'WYOMING', 'COMOROS', '+1452848777223', '+8654363680310', '(888) 874-9754', '65964', 'AGENT+SHIPPER+CONSIGNEE', '2017-11-05 01:38:52', '2017-11-05 01:38:52'),
(2, 'CS01', 'ADRIENNE WILDERMAN JR.', 'AUSTYN.HERMAN', '3508 GISLASON PLAINS SUITE 829\nSOUTH JANAECHESTER, LA 70245', '373 KATHARINA GARDENS APT. 246\nWEST CAMRONBERG, CA 02093-6201', 'AISHAFORT', 'MASSACHUSETTS', 'NIGER', '+3806140423501', '+4038244623551', '888-212-6569', '70574-1797', 'AGENT', '2017-11-05 01:38:53', '2017-11-05 01:38:53'),
(3, 'CS02', 'CAMRON JACOBSON', 'WILFORD78', '76923 GREYSON CAPE APT. 988\nNORTH COBYMOUTH, NH 67248-1482', '894 SHANNA ROAD\nSOUTH AUDREANNEMOUTH, UT 44031', 'NORTH ALI', 'INDIANA', 'NICARAGUA', '+6225304000830', '+2322529677946', '(877) 235-0186', '02680', 'AGENT+CONSIGNEE', '2017-11-05 01:38:53', '2017-11-05 01:38:53'),
(4, 'CS03', 'IGNACIO HARBER', 'ALDA.JAKUBOWSKI', '13459 MARC POINTS\nGONZALOSIDE, AL 51615', '974 DEMOND FORDS APT. 284\nEAST MARIANE, MI 95717', 'ALIZATON', 'NEVADA', 'VENEZUELA', '+3206135607586', '+7378223485012', '1-888-453-1704', '55146', 'SHIPPER', '2017-11-05 01:38:53', '2017-11-05 01:38:53'),
(5, 'CS04', 'MR. CRISTINA GOTTLIEB', 'FRANZ43', '2337 BOTSFORD VIEW SUITE 479\nCORMIERBOROUGH, CO 11033', '31743 GERTRUDE SUMMIT APT. 979\nSCHOWALTERSTAD, NH 56507', 'KELTONFORT', 'ALABAMA', 'CENTRAL AFRICAN REPUBLIC', '+3639693900443', '+8320497341544', '(800) 294-9720', '22789-3400', 'AGENT', '2017-11-05 01:38:53', '2017-11-05 01:38:53'),
(6, 'CS05', 'VICKIE WALTER', 'ELVIE.GLOVER', '397 JACEY MEADOW SUITE 641\nSTEHRTON, AR 61258', '21719 TATE TUNNEL\nNORTH LEXI, HI 17000', 'NEW BRANDONLAND', 'INDIANA', 'RUSSIAN FEDERATION', '+4392754412864', '+3777647429943', '1-877-446-2228', '94148', 'SHIPPER+CONSIGNEE', '2017-11-05 01:38:54', '2017-11-05 01:38:54'),
(7, 'CS06', 'SEBASTIAN SPORER', 'BEAULAH.GRADY', '69687 ELDA PIKE\nLAKE BUFORD, AL 21191', '5261 BRITTANY VIEW SUITE 902\nNEW JODY, DE 35471', 'EAST CANDACEPORT', 'MISSOURI', 'GHANA', '+7263381467953', '+9435030243196', '(866) 341-1800', '35749', 'CONSIGNEE', '2017-11-05 01:38:54', '2017-11-05 01:38:54'),
(8, 'CS07', 'ABDULLAH GRANT', 'TWILA.WISOKY', '71621 ANNA PLACE SUITE 028\nSOUTH MATEOMOUTH, MA 18129', '2078 EMMANUELLE PRAIRIE APT. 353\nNEW LEONLAND, MA 17971', 'WEST ADALBERTO', 'NEW YORK', 'NETHERLANDS', '+2786742527385', '+6106177811861', '855-200-9064', '05357-5573', 'AGENT+CONSIGNEE', '2017-11-05 01:38:54', '2017-11-05 01:38:54'),
(9, 'CS08', 'NYAH KUHN', 'JAMIR.FADEL', '735 AUSTIN LOCKS SUITE 192\nNOLANSIDE, MO 09144-9401', '54638 TURNER FORT\nSOUTH MARGARETTCHESTER, ID 48563-5426', 'EAST RHIANNATON', 'WASHINGTON', 'NEPAL', '+1526959933296', '+4117448663309', '855-623-1861', '71669-9741', 'SHIPPER', '2017-11-05 01:38:55', '2017-11-05 01:38:55'),
(10, 'CS09', 'RAMONA GOYETTE', 'MONIQUE.TORP', '30694 JEROMY RIDGES APT. 550\nPORT RAYMUNDOBOROUGH, MN 76572', '1495 ROMAGUERA RUN\nLAKE MADISON, IL 69332', 'NORTH BRODERICKPORT', 'ALASKA', 'ROMANIA', '+7892785522183', '+2901068290930', '844-627-9971', '47643-0052', 'CONSIGNEE', '2017-11-05 01:38:55', '2017-11-05 01:38:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_documents`
--

CREATE TABLE `master_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_documents`
--

INSERT INTO `master_documents` (`id`, `code`, `name`, `display_name`, `type`, `remark`, `created_at`, `updated_at`) VALUES
(1, '', 'MASTER B/L', 'MB/L', NULL, NULL, '2017-09-08 14:28:42', '2017-09-08 14:28:42'),
(2, '', 'HOUSE B/L', 'HB/L', NULL, NULL, '2017-09-08 14:28:42', '2017-09-08 14:28:42'),
(3, '', 'PART OF B/L', 'PART OFF', NULL, NULL, '2017-09-08 14:28:42', '2017-09-08 14:28:42'),
(4, '', 'PEB', 'PEB', NULL, NULL, '2017-09-08 14:28:42', '2017-09-08 14:28:42'),
(5, '', 'SPLIT B/L', 'SPLIT', NULL, NULL, '2017-09-08 14:28:42', '2017-09-08 14:28:42'),
(6, '', 'DELIVERY ORDER', 'DO', NULL, NULL, '2017-09-08 14:28:42', '2017-09-08 14:28:42'),
(7, '', 'CONTAINER AND SEAL', 'CONTAINER', NULL, NULL, '2017-09-08 14:28:42', '2017-09-08 14:28:42'),
(355, '	PB-00001	', 'OCEAN FREIGHT', NULL, 'payable', NULL, NULL, NULL),
(356, '	PB-00002	', 'THC - DESTINATION', NULL, 'payable', NULL, NULL, NULL),
(357, '	PB-00003	', 'B/L FEE', NULL, 'payable', NULL, NULL, NULL),
(358, '	PB-00004	', 'SWITCH B/L', NULL, 'payable', NULL, NULL, NULL),
(359, '	PB-00005	', 'TRUCKING', NULL, 'payable', NULL, NULL, NULL),
(360, '	PB-00006	', 'STORAGE', NULL, 'payable', NULL, NULL, NULL),
(361, '	PB-00007	', 'PEB', NULL, 'payable', NULL, NULL, NULL),
(362, '	PB-00008	', 'PNBP', NULL, 'payable', NULL, NULL, NULL),
(363, '	PB-00009	', 'C/O', NULL, 'payable', NULL, NULL, NULL),
(364, '	PB-00010	', 'R/C', NULL, 'payable', NULL, NULL, NULL),
(365, '	PB-00011	', 'TELEX', NULL, 'payable', NULL, NULL, NULL),
(366, '	PB-00012	', 'CBS', NULL, 'payable', NULL, NULL, NULL),
(367, '	PB-00013	', 'COD', NULL, 'payable', NULL, NULL, NULL),
(368, '	PB-00014	', 'B/L PART OFF', NULL, 'payable', NULL, NULL, NULL),
(369, '	PB-00015	', 'CFS', NULL, 'payable', NULL, NULL, NULL),
(370, '	PB-00016	', 'PU', NULL, 'payable', NULL, NULL, NULL),
(371, '	PB-00017	', 'D/O', NULL, 'payable', NULL, NULL, NULL),
(372, '	PB-00018	', 'DOCUMENT', NULL, 'payable', NULL, NULL, NULL),
(373, '	PB-00019	', 'HANDLING', NULL, 'payable', NULL, NULL, NULL),
(374, '	PB-00020	', 'COV', NULL, 'payable', NULL, NULL, NULL),
(375, '	PB-00021	', 'SEAWAY BILL', NULL, 'payable', NULL, NULL, NULL),
(376, '	PB-00022	', 'UNDERNAME', NULL, 'payable', NULL, NULL, NULL),
(377, '	PB-00023	', 'EXTRA INP CNTN', NULL, 'payable', NULL, NULL, NULL),
(378, '	PB-00024	', 'REBATE', NULL, 'payable', NULL, NULL, NULL),
(379, '	PB-00025	', 'PROFIT SHARE', NULL, 'payable', NULL, NULL, NULL),
(380, '	PB-00026	', 'INSURANCE', NULL, 'payable', NULL, NULL, NULL),
(381, '	PB-00027	', 'SEAL FEE', NULL, 'payable', NULL, NULL, NULL),
(382, '	PB-00028	', 'LIFT ON', NULL, 'payable', NULL, NULL, NULL),
(383, '	PB-00029	', 'LIFT OFF + PORT STORAGE', NULL, 'payable', NULL, NULL, NULL),
(384, '	PB-00030	', 'TRUCKING + C/O', NULL, 'payable', NULL, NULL, NULL),
(385, '	PB-00031	', 'AMENDMENT B/L', NULL, 'payable', NULL, NULL, NULL),
(386, '	PB-00032	', 'LOLO+ STORAGE + EDI + ADM', NULL, 'payable', NULL, NULL, NULL),
(387, '	PB-00033	', 'STAMP CORRECTION', NULL, 'payable', NULL, NULL, NULL),
(388, '	PB-00034	', 'REISSUE B/L', NULL, 'payable', NULL, NULL, NULL),
(389, '	PB-00035	', 'MEKANIK', NULL, 'payable', NULL, NULL, NULL),
(390, '	PB-00036	', 'SURVEYOR', NULL, 'payable', NULL, NULL, NULL),
(391, '	PB-00037	', 'SUCOFINDO', NULL, 'payable', NULL, NULL, NULL),
(392, '	PB-00038	', 'DETENTION', NULL, 'payable', NULL, NULL, NULL),
(393, '	PB-00039	', 'REVISE C/O', NULL, 'payable', NULL, NULL, NULL),
(394, '	PB-00040	', 'PEMBUATAN NIK', NULL, 'payable', NULL, NULL, NULL),
(395, '	PB-00041	', 'AMENDMENT', NULL, 'payable', NULL, NULL, NULL),
(396, '	PB-00042	', 'TRUCKING + PHYTOSANITARY', NULL, 'payable', NULL, NULL, NULL),
(397, '	PB-00043	', 'LEGALISIR INVOICE + PACKING LIST', NULL, 'payable', NULL, NULL, NULL),
(398, '	PB-00044	', 'TRANSFER EDI', NULL, 'payable', NULL, NULL, NULL),
(399, '	PB-00045	', 'EXTRA AMBIL GENSET', NULL, 'payable', NULL, NULL, NULL),
(400, '	PB-00046	', 'TMBK CLS', NULL, 'payable', NULL, NULL, NULL),
(401, '	PB-00047	', 'MANIFEST', NULL, 'payable', NULL, NULL, NULL),
(402, '	PB-00048	', 'RATE + UNDERNAME + TRUCKING', NULL, 'payable', NULL, NULL, NULL),
(403, '	PB-00049	', 'COMBINE B/L', NULL, 'payable', NULL, NULL, NULL),
(404, '	PB-00050	', 'PEMBATALAN TRUCKING + PHYTO', NULL, 'payable', NULL, NULL, NULL),
(405, '	PB-00051	', 'EXTRA COLOKAN', NULL, 'payable', NULL, NULL, NULL),
(406, '	PB-00052	', 'SOLAR', NULL, 'payable', NULL, NULL, NULL),
(407, '	PB-00053	', 'LIFT ON/OFF', NULL, 'payable', NULL, NULL, NULL),
(408, '	PB-00054	', 'REEFER PREPARATOR', NULL, 'payable', NULL, NULL, NULL),
(409, '	PB-00055	', 'COPY B/L', NULL, 'payable', NULL, NULL, NULL),
(410, '	PB-00056	', 'OCEAN FREIGHT + SWITCH B/L', NULL, 'payable', NULL, NULL, NULL),
(411, '	PB-00057	', 'COURIER FEE', NULL, 'payable', NULL, NULL, NULL),
(412, '	PB-00058	', 'LEGALISIR B/L', NULL, 'payable', NULL, NULL, NULL),
(413, '	PB-00059	', 'REISSUE C/O', NULL, 'payable', NULL, NULL, NULL),
(414, '	PB-00060	', 'FUMIGASI', NULL, 'payable', NULL, NULL, NULL),
(415, '	PB-00061	', 'STEVEDORING', NULL, 'payable', NULL, NULL, NULL),
(416, '	PB-00062	', 'MATERAI', NULL, 'payable', NULL, NULL, NULL),
(417, '	PB-00063	', 'RENOMINATION', NULL, 'payable', NULL, NULL, NULL),
(418, '	PB-00064	', 'REDOCUMENTATION', NULL, 'payable', NULL, NULL, NULL),
(419, '	PB-00065	', 'REPRINT B/L', NULL, 'payable', NULL, NULL, NULL),
(420, '	PB-00066	', 'DG CARGO', NULL, 'payable', NULL, NULL, NULL),
(421, '	PB-00067	', 'ALIH KAPAL', NULL, 'payable', NULL, NULL, NULL),
(422, '	PB-00068	', 'CANCEL PEB', NULL, 'payable', NULL, NULL, NULL),
(423, '	PB-00069	', 'ISPS', NULL, 'payable', NULL, NULL, NULL),
(424, '	PB-00070	', 'LIFT ON/OFF + STORAGE', NULL, 'payable', NULL, NULL, NULL),
(425, '	PB-00071	', 'KARANTINA', NULL, 'payable', NULL, NULL, NULL),
(426, '	PB-00072	', 'DAFTAR PHYTOSANITARY', NULL, 'payable', NULL, NULL, NULL),
(427, '	PB-00073	', 'CERTIFICATE PHYTOSANITARY', NULL, 'payable', NULL, NULL, NULL),
(428, '	PB-00074	', 'TEMBAK DOKUMEN', NULL, 'payable', NULL, NULL, NULL),
(429, '	PB-00075	', 'INCOMING CHARGES', NULL, 'payable', NULL, NULL, NULL),
(430, '	PB-00076	', 'ENS', NULL, 'payable', NULL, NULL, NULL),
(431, '	PB-00077	', 'KITE', NULL, 'payable', NULL, NULL, NULL),
(432, '	PB-00078	', 'ADDITIONAL FREE TIME', NULL, 'payable', NULL, NULL, NULL),
(433, '	PB-00079	', 'LOCAL CHARGES', NULL, 'payable', NULL, NULL, NULL),
(434, '	PB-00080	', 'TAX', NULL, 'payable', NULL, NULL, NULL),
(435, '	PB-00081	', 'LEGALISIR C/O', NULL, 'payable', NULL, NULL, NULL),
(436, '	PB-00082	', 'DEMMURAGE', NULL, 'payable', NULL, NULL, NULL),
(437, '	PB-00083	', 'SPLIT B/L', NULL, 'payable', NULL, NULL, NULL),
(438, '	PB-00084	', 'LEMBUR', NULL, 'payable', NULL, NULL, NULL),
(439, '	PB-00085	', 'TRUCKING + LOLO + STORAGE', NULL, 'payable', NULL, NULL, NULL),
(440, '	PB-00086	', 'EXTRA TRUCKING', NULL, 'payable', NULL, NULL, NULL),
(441, '	PB-00087	', 'PBM', NULL, 'payable', NULL, NULL, NULL),
(442, '	PB-00088	', 'CERTIFICATE', NULL, 'payable', NULL, NULL, NULL),
(443, '	PB-00089	', 'CERTIFICATE FREE TIME', NULL, 'payable', NULL, NULL, NULL),
(444, '	PB-00090	', 'LPBC', NULL, 'payable', NULL, NULL, NULL),
(445, '	PB-00091	', 'ACC PELAYARAN', NULL, 'payable', NULL, NULL, NULL),
(446, '	PB-00092	', 'HANDLING + PEB + PART OFF', NULL, 'payable', NULL, NULL, NULL),
(447, '	PB-00093	', 'MISCH CHARGES', NULL, 'payable', NULL, NULL, NULL),
(448, '	PB-00094	', 'TRUCKING + HANDLING', NULL, 'payable', NULL, NULL, NULL),
(449, '	PB-00095	', 'TRUCKING CANCEL', NULL, 'payable', NULL, NULL, NULL),
(450, '	PB-00096	', 'REPO CONTAINER', NULL, 'payable', NULL, NULL, NULL),
(451, '	PB-00097	', 'TRUCKING REPO', NULL, 'payable', NULL, NULL, NULL),
(452, '	PB-00098	', 'LATE TIME SI', NULL, 'payable', NULL, NULL, NULL),
(453, '	PB-00099	', 'ADM EXPORT', NULL, 'payable', NULL, NULL, NULL),
(454, '	PB-00100	', 'ADM BANK', NULL, 'payable', NULL, NULL, NULL),
(455, '	PB-00101	', 'AIR FREIGHT', NULL, 'payable', NULL, NULL, NULL),
(456, '	PB-00102	', 'OVERTIME', NULL, 'payable', NULL, NULL, NULL),
(457, '	PB-00103	', 'B/L FEE + ADM', NULL, 'payable', NULL, NULL, NULL),
(458, '	PB-00104	', 'OVERWEIGHT', NULL, 'payable', NULL, NULL, NULL),
(459, '	PB-00105	', 'ADM COD', NULL, 'payable', NULL, NULL, NULL),
(460, '	PB-00106	', 'ERS', NULL, 'payable', NULL, NULL, NULL),
(461, '	PB-00107	', 'PPH23', NULL, 'payable', NULL, NULL, NULL),
(462, '	PB-00108	', 'PEB + PART OFF', NULL, 'payable', NULL, NULL, NULL),
(463, '	PB-00109	', 'THC + BL + ADM + ETC', NULL, 'payable', NULL, NULL, NULL),
(464, '	PB-00110	', 'PDE', NULL, 'payable', NULL, NULL, NULL),
(465, '	PB-00111	', 'DISCRIPENSI', NULL, 'payable', NULL, NULL, NULL),
(466, '	PB-00112	', 'TRUCKING + LOLO + STORAGE + PEB', NULL, 'payable', NULL, NULL, NULL),
(467, '	PB-00113	', 'DG SURCHARGE', NULL, 'payable', NULL, NULL, NULL),
(468, '	PB-00114	', 'SMD', NULL, 'payable', NULL, NULL, NULL),
(469, '	PB-00115	', 'DEVANNING', NULL, 'payable', NULL, NULL, NULL),
(470, '	PB-00116	', 'REPRINT C/O', NULL, 'payable', NULL, NULL, NULL),
(471, '	PB-00117	', 'ADM + LIFT ON CANCEL', NULL, 'payable', NULL, NULL, NULL),
(472, '	PB-00118	', 'OPBC', NULL, 'payable', NULL, NULL, NULL),
(473, '	PB-00119	', 'ADM + D/O', NULL, 'payable', NULL, NULL, NULL),
(474, '	PB-00120	', 'RDM', NULL, 'payable', NULL, NULL, NULL),
(475, '	PB-00121	', 'WAREHOUSE', NULL, 'payable', NULL, NULL, NULL),
(476, '	PB-00122	', 'STUFFING + LAXING + HANDLING', NULL, 'payable', NULL, NULL, NULL),
(477, '	PB-00123	', 'DOCUMENT EXPORT', NULL, 'payable', NULL, NULL, NULL),
(478, '	PB-00124	', 'FORM C/O', NULL, 'payable', NULL, NULL, NULL),
(479, '	PB-00125	', 'PECAH POS UMUM', NULL, 'payable', NULL, NULL, NULL),
(480, '	PB-00126	', 'TEMBAK KARTU KUNING', NULL, 'payable', NULL, NULL, NULL),
(481, '	PB-00127	', 'MCF', NULL, 'payable', NULL, NULL, NULL),
(482, '	PB-00128	', 'MUTUAL PROFIT', NULL, 'payable', NULL, NULL, NULL),
(483, '	PB-00129	', 'OCEAN FREIGHT + DTHC', NULL, 'payable', NULL, NULL, NULL),
(484, '	PB-00130	', 'CONGESTION FEE', NULL, 'payable', NULL, NULL, NULL),
(485, '	PB-00131	', 'LOLO + STORAGE + EDI + ADM CANCEL', NULL, 'payable', NULL, NULL, NULL),
(486, '	PB-00132	', 'REHANDLING', NULL, 'payable', NULL, NULL, NULL),
(487, '	PB-00133	', 'CANCEL LIFT ON/OFF', NULL, 'payable', NULL, NULL, NULL),
(488, '	PB-00134	', 'LEMBUR DEPO', NULL, 'payable', NULL, NULL, NULL),
(489, '	PB-00135	', 'MUTUAL SHARE', NULL, 'payable', NULL, NULL, NULL),
(490, '	PB-00136	', 'INLAND', NULL, 'payable', NULL, NULL, NULL),
(491, '	PB-00137	', 'LATE FINAL DOCUMENT', NULL, 'payable', NULL, NULL, NULL),
(492, '	PB-00138	', 'TAMBAHAN UANG JALAN', NULL, 'payable', NULL, NULL, NULL),
(493, '	PB-00139	', 'LATE FINAL SI', NULL, 'payable', NULL, NULL, NULL),
(494, '	PB-00140	', 'FREE TIME DETENTION', NULL, 'payable', NULL, NULL, NULL),
(495, '	PB-00141	', 'AMF MANIFEST + CARGO DEC', NULL, 'payable', NULL, NULL, NULL),
(496, '	PB-00142	', 'CUSTOM', NULL, 'payable', NULL, NULL, NULL),
(497, '	PB-00143	', 'OVERWEIGHT SURCHARGES', NULL, 'payable', NULL, NULL, NULL),
(498, '	PB-00144	', 'TUSLAH', NULL, 'payable', NULL, NULL, NULL),
(499, '	PB-00145	', 'PPN', NULL, 'payable', NULL, NULL, NULL),
(500, '	PB-00146	', 'TEMBAK C/O', NULL, 'payable', NULL, NULL, NULL),
(501, '	PB-00147	', 'PORT HANDLING', NULL, 'payable', NULL, NULL, NULL),
(502, '	PB-00148	', 'UANG JALAN', NULL, 'payable', NULL, NULL, NULL),
(503, '	PB-00149	', 'BEA KELUAR', NULL, 'payable', NULL, NULL, NULL),
(504, '	PB-00150	', 'LEGALISIR SCCP', NULL, 'payable', NULL, NULL, NULL),
(505, '	PB-00151	', 'SURVEI', NULL, 'payable', NULL, NULL, NULL),
(506, '	PB-00152	', 'D/O MUAT', NULL, 'payable', NULL, NULL, NULL),
(507, '	PB-00153	', 'LATE MODIFICATION', NULL, 'payable', NULL, NULL, NULL),
(508, '	PB-00154	', 'COSTEM', NULL, 'payable', NULL, NULL, NULL),
(509, '	PB-00155	', 'ISPKA C/O', NULL, 'payable', NULL, NULL, NULL),
(510, '	PB-00156	', 'INSPECTION', NULL, 'payable', NULL, NULL, NULL),
(511, '	PB-00157	', 'LEGALISIR C/O DEPHAM', NULL, 'payable', NULL, NULL, NULL),
(512, '	PB-00158	', 'LEGALISIR C/O DEPLU', NULL, 'payable', NULL, NULL, NULL),
(513, '	PB-00159	', 'LEGALISIR C/O EMBASSY QATAR', NULL, 'payable', NULL, NULL, NULL),
(514, '	PB-00160	', 'OVERTIME TRUCKING', NULL, 'payable', NULL, NULL, NULL),
(515, '	PB-00161	', 'IP', NULL, 'payable', NULL, NULL, NULL),
(516, '	PB-00162	', 'TEMBAK C/O IP', NULL, 'payable', NULL, NULL, NULL),
(517, '	PB-00163	', 'CORECTION', NULL, 'payable', NULL, NULL, NULL),
(518, '	PB-00164	', 'SHIFTING COST', NULL, 'payable', NULL, NULL, NULL),
(519, '	PB-00165	', 'REPRINT SWITCH B/L', NULL, 'payable', NULL, NULL, NULL),
(520, '	PB-00166	', 'COSTEM HANDLING', NULL, 'payable', NULL, NULL, NULL),
(521, '	PB-00167	', 'LEGALISIR PEB', NULL, 'payable', NULL, NULL, NULL),
(522, '	PB-00168	', 'LAXING', NULL, 'payable', NULL, NULL, NULL),
(523, '	PB-00169	', 'LIFT OFF', NULL, 'payable', NULL, NULL, NULL),
(524, '	PB-00170	', 'DEPO PERTAMA', NULL, 'payable', NULL, NULL, NULL),
(525, '	PB-00171	', 'AFA', NULL, 'payable', NULL, NULL, NULL),
(526, '	PB-00172	', 'PSS', NULL, 'payable', NULL, NULL, NULL),
(527, '	PB-00173	', 'PART OFF B/L', NULL, 'payable', NULL, NULL, NULL),
(528, '	PB-00174	', 'TSC', NULL, 'payable', NULL, NULL, NULL),
(529, '	PB-00175	', 'LIFT ON + SEAL', NULL, 'payable', NULL, NULL, NULL),
(530, '	PB-00176	', 'DTHC', NULL, 'payable', NULL, NULL, NULL),
(531, '	PB-00177	', 'EARLY STACKING', NULL, 'payable', NULL, NULL, NULL),
(532, '	PB-00178	', 'PRINT EIR', NULL, 'payable', NULL, NULL, NULL),
(533, '	PB-00179	', 'THC - ORIGIN', NULL, 'payable', NULL, NULL, NULL),
(534, '	PB-00180	', 'KAWALAN', NULL, 'payable', NULL, NULL, NULL),
(535, '	PB-00181	', 'KURANG BAYAR OCEAN FREIGHT', NULL, 'payable', NULL, NULL, NULL),
(536, '	PB-00182	', 'AMS', NULL, 'payable', NULL, NULL, NULL),
(537, '	PB-00183	', 'EXPORT FEE', NULL, 'payable', NULL, NULL, NULL),
(538, '	PB-00184	', 'COST RECOVERY', NULL, 'payable', NULL, NULL, NULL),
(539, '	PB-00185	', 'BURUH', NULL, 'payable', NULL, NULL, NULL),
(540, '	PB-00186	', 'COURIER', NULL, 'payable', NULL, NULL, NULL),
(541, '	PB-00187	', 'KURANG BAYAR ADM', NULL, 'payable', NULL, NULL, NULL),
(542, '	PB-00188	', 'KURANG BAYAR C/O', NULL, 'payable', NULL, NULL, NULL),
(543, '	PB-00189	', 'READRESS MANIFEST', NULL, 'payable', NULL, NULL, NULL),
(544, '	PB-00190	', 'RO RO CARGO', NULL, 'payable', NULL, NULL, NULL),
(545, '	PB-00191	', 'MANIFEST AMENDMENT FEE', NULL, 'payable', NULL, NULL, NULL),
(546, '	PB-00192	', 'HANDAL JAYA', NULL, 'payable', NULL, NULL, NULL),
(547, '	PB-00193	', 'REDRESS MANIFEST', NULL, 'payable', NULL, NULL, NULL),
(548, '	PB-00194	', 'AFS', NULL, 'payable', NULL, NULL, NULL),
(549, '	PB-00195	', 'SEWA GENSET', NULL, 'payable', NULL, NULL, NULL),
(550, '	PB-00196	', 'SCS', NULL, 'payable', NULL, NULL, NULL),
(551, '	PB-00197	', 'FORWARDING CHARGES', NULL, 'payable', NULL, NULL, NULL),
(552, '	PB-00198	', 'PENALTY', NULL, 'payable', NULL, NULL, NULL),
(553, '	PB-00199	', 'ISS', NULL, 'payable', NULL, NULL, NULL),
(554, '	PB-00200	', 'BIAYA KURIR', NULL, 'payable', NULL, NULL, NULL),
(555, '	PB-00201	', 'SEQURITY', NULL, 'payable', NULL, NULL, NULL),
(556, '	PB-00202	', 'BIAYA PRINT', NULL, 'payable', NULL, NULL, NULL),
(557, '	PB-00203	', 'KURANG BAYAR MANIFEST', NULL, 'payable', NULL, NULL, NULL),
(558, '	PB-00204	', 'KURANG BAYAR SWITCH B/L', NULL, 'payable', NULL, NULL, NULL),
(559, '	PB-00205	', 'KURANG BAYAR SEAL', NULL, 'payable', NULL, NULL, NULL),
(560, '	PB-00206	', 'KURANG BAYAR THC', NULL, 'payable', NULL, NULL, NULL),
(561, '	PB-00207	', 'KURANG BAYAR REPRINT', NULL, 'payable', NULL, NULL, NULL),
(562, '	PB-00208	', 'KURANG BAYAR B/L', NULL, 'payable', NULL, NULL, NULL),
(563, '	PB-00209	', 'TEMBAK CLOSING', NULL, 'payable', NULL, NULL, NULL),
(564, '	PB-00210	', 'TARIK CONTAINER', NULL, 'payable', NULL, NULL, NULL),
(565, '	PB-00211	', 'CANCEL EXPORT', NULL, 'payable', NULL, NULL, NULL),
(566, '	PB-00212	', 'KURANG BAYAR CERTIFICATE', NULL, 'payable', NULL, NULL, NULL),
(567, '	PB-00213	', 'PPN MASUKAN B/L', NULL, 'payable', NULL, NULL, NULL),
(568, '	PB-00214	', 'PPN MASUKAN ADM', NULL, 'payable', NULL, NULL, NULL),
(569, '	PB-00215	', 'PART OFF PEB', NULL, 'payable', NULL, NULL, NULL),
(570, '	PB-00216	', 'FLATFILE', NULL, 'payable', NULL, NULL, NULL),
(571, '	PB-00217	', 'PPN MASUKAN CERTIFICATE', NULL, 'payable', NULL, NULL, NULL),
(572, '	PB-00218	', 'PPN MASUKAN SWITCH B/L', NULL, 'payable', NULL, NULL, NULL),
(573, '	PB-00219	', 'LATE PICK UP B/L', NULL, 'payable', NULL, NULL, NULL),
(574, '	PB-00220	', 'BIAYA SURAT PERNYATAAN', NULL, 'payable', NULL, NULL, NULL),
(575, '	PB-00221	', 'SSC', NULL, 'payable', NULL, NULL, NULL),
(576, '	PB-00222	', 'FSC', NULL, 'payable', NULL, NULL, NULL),
(577, '	PB-00223	', 'MAWB', NULL, 'payable', NULL, NULL, NULL),
(578, '	PB-00224	', 'DIV FEE', NULL, 'payable', NULL, NULL, NULL),
(579, '	PB-00225	', 'PAI', NULL, 'payable', NULL, NULL, NULL),
(580, '	PB-00226	', 'PPN MASUKAN AMENDMENT', NULL, 'payable', NULL, NULL, NULL),
(581, '	PB-00227	', 'PPN MASUKAN REISSUE', NULL, 'payable', NULL, NULL, NULL),
(582, '	PB-00228	', 'PPN MASUKAN MANIFEST', NULL, 'payable', NULL, NULL, NULL),
(583, '	PB-00229	', 'EMI', NULL, 'payable', NULL, NULL, NULL),
(584, '	PB-00230	', 'PPN MASUKAN ADM COD', NULL, 'payable', NULL, NULL, NULL),
(585, '	PB-00231	', 'DOC FEE HAZARDOUS CARGO', NULL, 'payable', NULL, NULL, NULL),
(586, '	PB-00232	', 'PPN MASUKAN DOC FEE HAZARDOUS CARGO', NULL, 'payable', NULL, NULL, NULL),
(587, '	PB-00233	', 'HAZARDOUS DOC LODGEMENT', NULL, 'payable', NULL, NULL, NULL),
(588, '	PB-00234	', 'APEX MARITIME CO INC', NULL, 'payable', NULL, NULL, NULL),
(589, 'PB-00235', 'BIAYA KARTU PAS', NULL, 'payable', NULL, NULL, NULL),
(590, 'PB-00236', 'PORT ADDITIONAL', NULL, 'payable', NULL, NULL, NULL),
(591, 'PB-00237', 'SFS', NULL, 'payable', NULL, NULL, NULL),
(592, 'PB-00238', 'CGO DECLAT', NULL, 'payable', NULL, NULL, NULL),
(593, 'PB-00239', 'BIAYA SEAL', NULL, 'payable', NULL, NULL, NULL),
(594, 'PB-00240', 'ADEN GULF', NULL, 'payable', NULL, NULL, NULL),
(595, 'PB-00241', 'COMBO TRUCKING', NULL, 'payable', NULL, NULL, NULL),
(596, 'PB-00242', 'GOVERNMENT AGENCY', NULL, 'payable', NULL, NULL, NULL),
(597, 'PB-00243', 'KURANG BAYAR TELEX', NULL, 'payable', NULL, NULL, NULL),
(598, 'PB-00244', 'BIAYA FOTOCOPY', NULL, 'payable', NULL, NULL, NULL),
(599, 'PB-00245', 'LOLO STORAGE', NULL, 'payable', NULL, NULL, NULL),
(600, 'PB-00246', 'PPN MASUKAN TELEX', NULL, 'payable', NULL, NULL, NULL),
(601, 'PB-00247', 'PT. GIHON INTERNATIONAL CARGO', NULL, 'payable', NULL, NULL, NULL),
(602, 'PB-00248', 'DESTINATION CONTAINER', NULL, 'payable', NULL, NULL, NULL),
(603, 'PB-00249', 'OCEAN FREIGHT ( IMPORT )', NULL, 'payable', NULL, NULL, NULL),
(604, 'PB-00251', 'PPN MASUKAN FUMIGASI', NULL, 'payable', NULL, NULL, NULL),
(605, 'PB-00252', 'ACC PELAYARAN', NULL, 'payable', NULL, NULL, NULL),
(606, 'PB-00253', 'BIAYA TIMBANG ISI', NULL, 'payable', NULL, NULL, NULL),
(607, 'PB-00254', 'BIAYA TIMBANG KOSONG', NULL, 'payable', NULL, NULL, NULL),
(608, 'PB-00255', 'BIAYA CANCEL KARANTINA', NULL, 'payable', NULL, NULL, NULL),
(609, 'PB-00256', 'SSD', NULL, 'payable', NULL, NULL, NULL),
(610, 'PB-00257', 'BIAYA TRANSPORT', NULL, 'payable', NULL, NULL, NULL),
(611, 'PB-00258', 'PEMBATALAN PEB & UNDERNAME', NULL, 'payable', NULL, NULL, NULL),
(612, 'PB-00259', 'ACE-M1', NULL, 'payable', NULL, NULL, NULL),
(613, 'PB-00260', 'APF', NULL, 'payable', NULL, NULL, NULL),
(614, 'PB-00261', 'OTHER CHARGES', NULL, 'payable', NULL, NULL, NULL),
(615, 'PB-00262', 'EXTEND CLOSSING', NULL, 'payable', NULL, NULL, NULL),
(616, 'PB-00263', 'B. PENGGANTIAN LIFT ON', NULL, 'payable', NULL, NULL, NULL),
(617, 'PB-00264', 'B. PENGGANTIAN STORAGE', NULL, 'payable', NULL, NULL, NULL),
(618, 'PB-00265', 'B. PENGGANTIAN FUMIGASI', NULL, 'payable', NULL, NULL, NULL),
(619, 'PB-00266', 'B. PENGGANTIAN HANDLING', NULL, 'payable', NULL, NULL, NULL),
(620, 'PB-00267', 'B. PENGGANTIAN KITE', NULL, 'payable', NULL, NULL, NULL),
(621, 'PB-00268', 'B. PENGGANTIAN THC', NULL, 'payable', NULL, NULL, NULL),
(622, 'PB-00269', 'B. PENGGANTIAN SEAL', NULL, 'payable', NULL, NULL, NULL),
(623, 'PB-00270', 'B. PENGGANTIAN LIFT OFF', NULL, 'payable', NULL, NULL, NULL),
(624, 'PB-00271', 'B. PENGGANTIAN LATE FINAL SI', NULL, 'payable', NULL, NULL, NULL),
(625, 'PB-00272', 'B. PENGGANTIAN PEB', NULL, 'payable', NULL, NULL, NULL),
(626, 'PB-00273', 'B. PENGGANTIAN OCEAN FREIGHT', NULL, 'payable', NULL, NULL, NULL),
(627, 'PB-00274', 'B. PENGGANTIAN PROFIT SHARE', NULL, 'payable', NULL, NULL, NULL),
(628, 'PB-00275', 'LOW SURFUR', NULL, 'payable', NULL, NULL, NULL),
(629, 'PB-00276', 'ENTRY + EXPORT SUMMARY', NULL, 'payable', NULL, NULL, NULL),
(630, 'PB-00277', 'B. PENGGANTIAN CLOSSING', NULL, 'payable', NULL, NULL, NULL),
(631, 'PB-00278', 'B. PENGGANTIAN LIFT ON/LIFT OFF', NULL, 'payable', NULL, NULL, NULL),
(632, 'PB-00279', 'DESTINATION CERTIFICATE', NULL, 'payable', NULL, NULL, NULL),
(633, 'PB-00280', 'KURANG BAYAR TRUCKING', NULL, 'payable', NULL, NULL, NULL),
(634, 'PB-00281', 'EQUIPMENT MANAGEMENT IMPORT', NULL, 'payable', NULL, NULL, NULL),
(635, 'PB-00282', 'TEMBAK NPE', NULL, 'payable', NULL, NULL, NULL),
(636, 'PB-00283', 'SURVEY CONTAINER', NULL, 'payable', NULL, NULL, NULL),
(637, 'PB-00284', 'PARKIR', NULL, 'payable', NULL, NULL, NULL),
(638, 'PB-00285', 'AFR', NULL, 'payable', NULL, NULL, NULL),
(639, 'PB-00286', 'BATAL DOCUMENT', NULL, 'payable', NULL, NULL, NULL),
(640, 'PB-00287', 'CSR', NULL, 'payable', NULL, NULL, NULL),
(641, 'PB-00288', 'PCS', NULL, 'payable', NULL, NULL, NULL),
(642, 'PB-00289', 'ADM - IMPORT', NULL, 'payable', NULL, NULL, NULL),
(643, 'PB-00290', 'CIC DESTINATION', NULL, 'payable', NULL, NULL, NULL),
(644, 'PB-00291', 'PENGIRIMAN DOCUMENT', NULL, 'payable', NULL, NULL, NULL),
(645, 'PB-00292', 'BATAL CONTAINER', NULL, 'payable', NULL, NULL, NULL),
(646, 'PB-00293', 'VGM WEIGHTING', NULL, 'payable', NULL, NULL, NULL),
(647, 'PB-00294', 'VGM CERTIFICATE', NULL, 'payable', NULL, NULL, NULL),
(648, 'PB-00295', 'NPE', NULL, 'payable', NULL, NULL, NULL),
(649, 'PB-00296', 'BIAYA CLOSING DOCUMENT', NULL, 'payable', NULL, NULL, NULL),
(650, 'PB-00297', 'STICKER IMO', NULL, 'payable', NULL, NULL, NULL),
(651, 'PB-00298', 'BAF', NULL, 'payable', NULL, NULL, NULL),
(652, 'PB-00299', 'TEMBAK SEAL', NULL, 'payable', NULL, NULL, NULL),
(653, 'PB-00300', 'B. SURAT PENGANTAR RE-DRESS', NULL, 'payable', NULL, NULL, NULL),
(654, 'PB-00301', 'BIAYA SURAT PENGANTAR RE-DRESS', NULL, 'payable', NULL, NULL, NULL),
(655, 'PB-00302', 'REPLAY COST', NULL, 'payable', NULL, NULL, NULL),
(656, 'PB-00303', 'OUTPORT ADDITIONAL ORIGIN', NULL, 'payable', NULL, NULL, NULL),
(657, 'PB-00304', 'PPN MASUKAN FUMIGASI', NULL, 'payable', NULL, NULL, NULL),
(658, 'PB-00305', 'EXPORT DECLARATION', NULL, 'payable', NULL, NULL, NULL),
(659, 'PB-00306', 'BIAYA DOCUMENT REDRESS MANIFEST', NULL, 'payable', NULL, NULL, NULL),
(660, 'PB-00307', 'REPO ISI', NULL, 'payable', NULL, NULL, NULL),
(661, 'PB-00308', 'REPO KOSONGAN', NULL, 'payable', NULL, NULL, NULL),
(662, 'PB-00309', 'BIAYA OUTPORT ADDITIONAL DESTINATION', NULL, 'payable', NULL, NULL, NULL),
(663, 'PB-00310', 'BIAYA PENGELUARAN SYAHBANDAR', NULL, 'payable', NULL, NULL, NULL),
(664, 'PB-00311', 'BIAYA PENGURUSAN CONTAINER', NULL, 'payable', NULL, NULL, NULL),
(665, 'PB-00312', 'BIAYA TIMBANG CONTAINER', NULL, 'payable', NULL, NULL, NULL),
(666, 'PB-00313', 'PENGIRIMAN', NULL, 'payable', NULL, NULL, NULL),
(667, 'PB-00314', 'BIAYA LAS', NULL, 'payable', NULL, NULL, NULL),
(668, 'PB-00315', 'LATE CONTAINER', NULL, 'payable', NULL, NULL, NULL),
(669, 'PB-00316', 'PPN MASUKAN LATE CONTAINER', NULL, 'payable', NULL, NULL, NULL),
(670, 'PB-00317', 'ACC PLANNER', NULL, 'payable', NULL, NULL, NULL),
(671, 'PB-00318', 'BIAYA KRANI GATE', NULL, 'payable', NULL, NULL, NULL),
(672, 'PB-00319', 'KULI', NULL, 'payable', NULL, NULL, NULL),
(673, 'PB-00320', 'DDF', NULL, 'payable', NULL, NULL, NULL),
(674, 'PB-00321', 'LATE COMING', NULL, 'payable', NULL, NULL, NULL),
(675, 'PB-00322', 'PRINT B/L', NULL, 'payable', NULL, NULL, NULL),
(676, 'PB-00323', 'TALLY', NULL, 'payable', NULL, NULL, NULL),
(677, 'PB-00324', 'HANDLING CUSTOM', NULL, 'payable', NULL, NULL, NULL),
(678, 'PB-00325', 'CGC', NULL, 'payable', NULL, NULL, NULL),
(679, 'PB-00326', 'FSC', NULL, 'payable', NULL, NULL, NULL),
(680, 'PB-00327', 'CCB', NULL, 'payable', NULL, NULL, NULL),
(681, 'PB-00328', 'EQUIPMENT EXPORT DEMMURAGE', NULL, 'payable', NULL, NULL, NULL),
(682, 'PB-00329', 'HAZARDOUS CARGO', NULL, 'payable', NULL, NULL, NULL),
(683, 'PB-00330', 'PPN MASUKAN HAZARDOUS CARGO', NULL, 'payable', NULL, NULL, NULL),
(684, 'PB-00331', 'CV. GRAND EAGER GENSET', NULL, 'payable', NULL, NULL, NULL),
(685, 'PB-00332', 'TIMBANGAN KOSONG', NULL, 'payable', NULL, NULL, NULL),
(686, 'PB-00333', 'LSS', NULL, 'payable', NULL, NULL, NULL),
(687, 'PB-00334', 'ADMINISTRASI', NULL, 'payable', NULL, NULL, NULL),
(688, 'PB-00335', 'HAZARDOUS CERTIFICATE', NULL, 'payable', NULL, NULL, NULL),
(689, 'PB-00336', 'PPN HAZARDOUS CERTIFICATE', NULL, 'payable', NULL, NULL, NULL),
(690, 'PB-00337', 'Additional', NULL, 'payable', NULL, NULL, NULL),
(691, 'PB-00338', 'BIAYA TAMBAHAN', NULL, 'payable', NULL, NULL, NULL),
(692, 'PB-00339', 'REPAIR CONTAINER', NULL, 'payable', NULL, NULL, NULL),
(693, 'PB-00340', 'PENITIPAN CONTAINER', NULL, 'payable', NULL, NULL, NULL),
(694, 'PB-00341', 'RENUMBER', NULL, 'payable', NULL, NULL, NULL),
(695, 'PB-00342', 'FREIGHT SURCHARGE', NULL, 'payable', NULL, NULL, NULL),
(696, 'PB-00343', 'BIAYA CLEANING', NULL, 'payable', NULL, NULL, NULL),
(697, 'PB-00344', 'BIAYA TELLY SHEET', NULL, 'payable', NULL, NULL, NULL),
(698, 'PB-00345', 'BIAYA PENGIRIM', NULL, 'payable', NULL, NULL, NULL),
(699, 'PB-00346', 'BIAYA PENGIRIMAN', NULL, 'payable', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_ports`
--

CREATE TABLE `master_ports` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nick_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `loading` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_ports`
--

INSERT INTO `master_ports` (`id`, `code`, `nick_name`, `address`, `city`, `province`, `country`, `type`, `loading`, `created_at`, `updated_at`) VALUES
(1, 'PO01', 'JKT', NULL, 'JAKARTA', NULL, 'INDONESIA', 'origin', '2', '2017-11-05 01:38:57', '2017-11-05 01:38:57'),
(2, 'PO02', 'SBY', NULL, 'SURABAYA', NULL, 'INDONESIA', 'origin', '2', '2017-11-05 01:38:57', '2017-11-05 01:38:57'),
(3, 'PO03', 'BLW', NULL, 'BELAWAN', NULL, 'INDONESIA', 'destination', '2', '2017-11-05 01:38:57', '2017-11-05 01:38:57'),
(4, 'PO04', 'SMR', NULL, 'SEMARANG', NULL, 'INDONESIA', 'origin', '2', '2017-11-05 01:38:57', '2017-11-05 01:38:57'),
(5, 'PO05', 'PJG', NULL, 'PANJANG', NULL, 'INDONESIA', 'origin', '2', '2017-11-05 01:38:57', '2017-11-05 01:38:57'),
(6, 'PO06', 'PEN', NULL, 'PENANG', NULL, 'INDONESIA', 'origin', '2', '2017-11-05 01:38:57', '2017-11-05 01:38:57'),
(7, 'PO07', 'CGK', NULL, 'SOEKARNO HATTA', NULL, 'INDONESIA', 'origin', '2', '2017-11-05 01:38:57', '2017-11-05 01:38:57'),
(8, 'PO08', 'HCH', NULL, 'HOCHIMINCH', NULL, 'VIETNAM', 'destination', '2', '2017-11-05 01:38:57', '2017-11-05 01:38:57'),
(9, 'PO09', 'PLM', NULL, 'PALEMBANG', NULL, 'INDONESIA', 'origin', '2', '2017-11-05 01:38:58', '2017-11-05 01:38:58'),
(10, 'PO364', 'PDG', NULL, 'PADANG', NULL, 'INDONESIA', 'destination', '2', '2017-11-05 01:38:58', '2017-11-05 01:38:58'),
(11, 'PO330', 'KWT', NULL, 'KUWAIT', NULL, 'SAUDI ARABIA', 'destination', '2', '2017-11-05 01:38:58', '2017-11-05 01:38:58'),
(12, 'PO365', 'HONGKONG', NULL, 'HONGKONG', NULL, 'HONGKONG', 'destination', '2', '2017-11-05 01:38:58', '2017-11-05 01:38:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_rates`
--

CREATE TABLE `master_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_roles`
--

CREATE TABLE `master_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_roles`
--

INSERT INTO `master_roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'apalah apalah', '2017-11-05 01:38:51', '2017-11-05 01:38:51'),
(2, 'operation', 'apalah apalah', '2017-11-05 01:38:51', '2017-11-05 01:38:51'),
(3, 'marketing', 'apalah apalah', '2017-11-05 01:38:51', '2017-11-05 01:38:51'),
(4, 'pricing', 'apalah apalah', '2017-11-05 01:38:51', '2017-11-05 01:38:51'),
(5, 'invoice', 'apalah apalah', '2017-11-05 01:38:51', '2017-11-05 01:38:51'),
(6, 'payable', 'apalah apalah', '2017-11-05 01:38:51', '2017-11-05 01:38:51'),
(7, 'approvepay', 'apalah apalah', '2017-11-05 01:38:51', '2017-11-05 01:38:51'),
(8, 'pajak', 'apalah apalah', '2017-11-05 01:38:51', '2017-11-05 01:38:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_terms`
--

CREATE TABLE `master_terms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_terms`
--

INSERT INTO `master_terms` (`id`, `name`, `type`, `days`, `created_at`, `updated_at`) VALUES
(1, 'CREDIT', '2', 0, '2017-11-05 01:38:58', '2017-11-05 01:38:58'),
(2, 'CASH', '1', 0, '2017-11-05 01:38:58', '2017-11-05 01:38:58'),
(3, 'COD', '2', 0, '2017-11-05 01:38:59', '2017-11-05 01:38:59'),
(4, '1 DAY AFTER RECEIVING B/L', '2', 0, '2017-11-05 01:38:59', '2017-11-05 01:38:59'),
(5, '2 DAYS', '2', 2, '2017-11-05 01:39:00', '2017-11-05 01:39:00'),
(6, '3 DAYS', '2', 3, '2017-11-05 01:39:00', '2017-11-05 01:39:00'),
(7, '45 DAYS', '2', 45, '2017-11-05 01:39:00', '2017-11-05 01:39:00'),
(8, '1 WEEK', '2', 7, '2017-11-05 01:39:00', '2017-11-05 01:39:00'),
(9, '1 WEEK FROM ETA', '2', 7, '2017-11-05 01:39:00', '2017-11-05 01:39:00'),
(10, '1 WEEK AFTER RECEIVING B/L', '2', 0, '2017-11-05 01:39:00', '2017-11-05 01:39:00'),
(11, '2 WEEKS', '2', 14, '2017-11-05 01:39:00', '2017-11-05 01:39:00'),
(12, '3 WEEKS', '2', 21, '2017-11-05 01:39:01', '2017-11-05 01:39:01'),
(13, '1 MONTH', '2', 1, '2017-11-05 01:39:01', '2017-11-05 01:39:01'),
(14, '2 MONTHS', '2', 0, '2017-11-05 01:39:01', '2017-11-05 01:39:01'),
(15, '2 MONTHS FROM ETD', '2', 0, '2017-11-05 01:39:01', '2017-11-05 01:39:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_units`
--

CREATE TABLE `master_units` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_units`
--

INSERT INTO `master_units` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'QUIBUSDAM', 'QUI', '2017-11-05 01:38:53', '2017-11-05 01:38:53'),
(2, 'PERSPICIATIS', 'FUGIAT', '2017-11-05 01:38:53', '2017-11-05 01:38:53'),
(3, 'EOS', 'INVENTORE', '2017-11-05 01:38:53', '2017-11-05 01:38:53'),
(4, 'FUGIT', 'VOLUPTATUM', '2017-11-05 01:38:53', '2017-11-05 01:38:53'),
(5, 'ID', 'DOLORES', '2017-11-05 01:38:54', '2017-11-05 01:38:54'),
(6, 'DOLOREM', 'UT', '2017-11-05 01:38:54', '2017-11-05 01:38:54'),
(7, 'EST', 'QUI', '2017-11-05 01:38:54', '2017-11-05 01:38:54'),
(8, 'QUO', 'VOLUPTAS', '2017-11-05 01:38:54', '2017-11-05 01:38:54'),
(9, 'MOLLITIA', 'NON', '2017-11-05 01:38:55', '2017-11-05 01:38:55'),
(10, 'UNDE', 'PLACEAT', '2017-11-05 01:38:56', '2017-11-05 01:38:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_vendors`
--

CREATE TABLE `master_vendors` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nick_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci,
  `address2` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone1` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_vendors`
--

INSERT INTO `master_vendors` (`id`, `code`, `name`, `nick_name`, `address1`, `address2`, `city`, `province`, `country`, `phone1`, `phone2`, `fax`, `zipcode`, `remark`, `type`, `created_at`, `updated_at`) VALUES
(1, 'VD00', 'SEDRICK SCHOEN', 'ELLSWORTH.BRADTKE', '74213 NYASIA DALE SUITE 023\nLAKE SHERMAN, OR 76617-8090', '1959 WINIFRED ISLANDS\nEAST RODOLFOLAND, IN 41310', 'RICHIETON', 'NEW MEXICO', 'NORTHERN MARIANA ISLANDS', '+5134113044331', '+2250758146923', '(844) 473-0484', '77115', 'WHATEVER', 'pelayaran', '2017-11-05 01:38:52', '2017-11-05 01:38:52'),
(2, 'VD01', 'BRAIN MACEJKOVIC', 'MARLIN26', '147 BROWN HILL APT. 239\nNORTH SANTINASHIRE, NE 71569', '3649 TERRILL SPRINGS APT. 023\nLAKE JAYDONBOROUGH, DE 22194-8940', 'ROMAINEVIEW', 'MINNESOTA', 'PALESTINIAN TERRITORIES', '+2360045476977', '+4802547588383', '855.264.4778', '23397', 'WHATEVER', 'marketing', '2017-11-05 01:38:53', '2017-11-05 01:38:53'),
(3, 'VD02', 'MRS. ANNABEL TOY', 'TURNER.NEWTON', '8465 DONNY ISLE SUITE 545\nLAKE ISAC, NY 19400', '84187 D\'AMORE WALK APT. 728\nBOTSFORDMOUTH, PA 91117-0568', 'NEW NONAHAVEN', 'MISSOURI', 'IRAQ', '+5711547592652', '+7473747692798', '866.278.2755', '87165-7449', 'WHATEVER', 'marketing', '2017-11-05 01:38:53', '2017-11-05 01:38:53'),
(4, 'VD03', 'PROF. WILLA KEMMER', 'MEDHURST.ADELINE', '639 SAWAYN PRAIRIE\nLAKE FLAVIO, WI 34703', '38217 ANNIE FALLS APT. 681\nPORT ARIANESHIRE, KS 67258-4509', 'RIPPINBERG', 'NEW MEXICO', 'ITALY', '+3484291181212', '+8271050542401', '(866) 442-5462', '81723', 'WHATEVER', 'payable', '2017-11-05 01:38:53', '2017-11-05 01:38:53'),
(5, 'VD04', 'MR. COBY SHIELDS', 'GBLOCK', '986 KIHN SHOALS\nWEST RONALDO, DC 32452', '94409 HYATT GREENS\nPORT LORENZAFORT, OK 40446', 'WEST DEE', 'MAINE', 'ISRAEL', '+1902195074251', '+1665728148640', '(877) 563-8920', '43879-9158', 'WHATEVER', 'pelayaran', '2017-11-05 01:38:54', '2017-11-05 01:38:54'),
(6, 'VD05', 'KATHLYN STEUBER III', 'VANDERVORT.KIRSTIN', '72097 ORLO PLAZA\nNEW SILASVILLE, OH 79899-5725', '2215 WIZA SQUARES APT. 290\nLAKE KORY, ND 01012', 'NORTH RUTH', 'NORTH CAROLINA', 'SWAZILAND', '+5930052745628', '+2686937518446', '800.410.3667', '95231-4225', 'WHATEVER', 'pelayaran', '2017-11-05 01:38:54', '2017-11-05 01:38:54'),
(7, 'VD06', 'BELLA WISOKY', 'BRAULIO05', '38160 LARKIN LOCKS SUITE 193\nSOUTH PIPER, NJ 42988', '5922 MAYERT MOUNTAINS SUITE 048\nKRYSTELBOROUGH, FL 66750-4181', 'WEST CARLOS', 'HAWAII', 'RUSSIAN FEDERATION', '+5653643373628', '+1583749136545', '855-855-0632', '95107-2904', 'WHATEVER', 'marketing', '2017-11-05 01:38:54', '2017-11-05 01:38:54'),
(8, 'VD07', 'AVIS CARTWRIGHT', 'SKILES.EDISON', '7974 DICKENS ROAD SUITE 563\nO\'REILLYTOWN, MS 97119-4687', '1486 LONNY SPRING\nPORT PABLOBURGH, IL 62738-7747', 'LAKE DEXTER', 'NORTH CAROLINA', 'LUXEMBOURG', '+7903660880275', '+4467354517674', '866.252.0236', '93904', 'WHATEVER', 'pelayaran', '2017-11-05 01:38:54', '2017-11-05 01:38:54'),
(9, 'VD08', 'DR. CORDELL UPTON DDS', 'MDOUGLAS', '204 AVA BROOKS APT. 622\nO\'KEEFEMOUTH, IA 25273', '1494 CIARA CANYON SUITE 030\nPORT ORIEFORT, OH 74890-5701', 'NEW RANDI', 'ILLINOIS', 'MOZAMBIQUE', '+4417802047688', '+3246101949388', '888.719.2836', '99997', 'WHATEVER', 'pelayaran', '2017-11-05 01:38:55', '2017-11-05 01:38:55'),
(10, 'VD09', 'DR. DOCK SIPES IV', 'WKEMMER', '382 HAMMES STRAVENUE\nSOUTH EFRAINSIDE, MD 57115', '81081 SAWAYN ROAD APT. 027\nLIZALAND, IL 53509', 'HODKIEWICZLAND', 'GEORGIA', 'GUINEA', '+7985070258275', '+6855483339939', '1-866-400-9945', '63146', 'WHATEVER', 'pelayaran', '2017-11-05 01:38:55', '2017-11-05 01:38:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_08_10_045752_create_master_units_table', 1),
(4, '2017_08_10_045843_create_master_customers_table', 1),
(5, '2017_08_10_045902_create_master_vendors_table', 1),
(6, '2017_08_10_050044_create_master_documents_table', 1),
(7, '2017_08_10_050107_create_master_ports_table', 1),
(8, '2017_08_10_063144_create_master_terms_table', 1),
(9, '2017_08_10_064814_create_master_banks_table', 1),
(10, '2017_08_10_070931_create_master_rates_table', 1),
(11, '2017_08_12_160032_create_master_roles_table', 1),
(12, '2017_08_16_033155_create_master_currencies_table', 1),
(13, '2017_08_30_170111_create_job_sheets_table', 1),
(14, '2017_08_31_120056_create_marketings_table', 1),
(15, '2017_09_06_035546_create_payments_table', 1),
(16, '2017_09_09_170703_create_invoices_table', 1),
(17, '2017_09_10_035750_create_payables_table', 1),
(18, '2017_09_10_035819_create_receivables_table', 1),
(19, '2017_09_10_040857_create_r_cs_table', 1),
(20, '2017_09_10_082722_create_revisions_table', 1),
(21, '2017_09_13_031950_create_requests_table', 1),
(22, '2017_09_14_072208_create_references_table', 1),
(23, '2017_09_24_081453_create_receivable_payments_table', 1),
(24, '2017_09_25_152545_create_reimbursements_table', 1),
(25, '2017_09_29_050256_create_invoice_documents_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payables`
--

CREATE TABLE `payables` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `jobsheet_id` int(10) UNSIGNED NOT NULL,
  `document_id` int(10) UNSIGNED DEFAULT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` int(11) DEFAULT NULL,
  `payment_currency` int(11) DEFAULT NULL,
  `quantity` decimal(8,2) DEFAULT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `total` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `payment` int(11) DEFAULT NULL,
  `currency` int(11) DEFAULT NULL,
  `date_payment` date NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_docs`
--

CREATE TABLE `payment_docs` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(10) UNSIGNED NOT NULL,
  `add_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rc`
--

CREATE TABLE `rc` (
  `id` int(10) UNSIGNED NOT NULL,
  `jobsheet_id` int(10) UNSIGNED NOT NULL,
  `rc_document_id` int(10) UNSIGNED NOT NULL,
  `rc_vendor_id` int(10) UNSIGNED NOT NULL,
  `rc_unit_id` int(10) UNSIGNED DEFAULT NULL,
  `rc_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rc_currency` int(11) DEFAULT NULL,
  `rc_payment_currency` int(11) DEFAULT NULL,
  `rc_quantity` decimal(8,2) NOT NULL,
  `rc_total` double DEFAULT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rc_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ' ',
  `payment_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `receivables`
--

CREATE TABLE `receivables` (
  `id` int(10) UNSIGNED NOT NULL,
  `jobsheet_id` int(10) UNSIGNED NOT NULL,
  `rec_marketing_id` int(10) UNSIGNED NOT NULL,
  `rec_invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `rec_document_id` int(10) UNSIGNED DEFAULT NULL,
  `rec_unit_id` int(10) UNSIGNED DEFAULT NULL,
  `rec_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rec_currency` int(11) DEFAULT NULL,
  `rec_quantity` decimal(8,2) DEFAULT NULL,
  `rec_tax` int(11) DEFAULT NULL,
  `rec_tax_amount` int(11) DEFAULT NULL,
  `rec_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rec_charge_type` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `receivable_payments`
--

CREATE TABLE `receivable_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `jobsheet_id` int(10) UNSIGNED NOT NULL,
  `no_form` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` int(11) NOT NULL DEFAULT '0',
  `payment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `amount_rec` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `pph` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `adm_bank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `other` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `references`
--

CREATE TABLE `references` (
  `id` int(10) UNSIGNED NOT NULL,
  `jobsheet_id` int(10) UNSIGNED NOT NULL,
  `document_id` int(10) UNSIGNED NOT NULL,
  `ref_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reimbursements`
--

CREATE TABLE `reimbursements` (
  `id` int(10) UNSIGNED NOT NULL,
  `jobsheet_id` int(10) UNSIGNED NOT NULL,
  `rmb_marketing_id` int(10) UNSIGNED NOT NULL,
  `rmb_document_id` int(10) UNSIGNED DEFAULT NULL,
  `rmb_unit_id` int(10) UNSIGNED DEFAULT NULL,
  `rmb_invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `rmb_vendor_id` int(10) UNSIGNED DEFAULT NULL,
  `rmb_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rmb_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rmb_currency` int(11) DEFAULT NULL,
  `rmb_quantity` decimal(8,2) DEFAULT NULL,
  `rmb_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `requests`
--

CREATE TABLE `requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `jobsheet_id` int(10) UNSIGNED DEFAULT NULL,
  `payable_id` int(10) UNSIGNED DEFAULT NULL,
  `rc_id` int(10) UNSIGNED DEFAULT NULL,
  `bank_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Cash or Bank',
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `revisions`
--

CREATE TABLE `revisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `jobsheet_id` int(10) UNSIGNED NOT NULL,
  `sender` int(10) UNSIGNED NOT NULL,
  `receiver` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `address1` text COLLATE utf8mb4_unicode_ci,
  `address2` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `phone1` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `phone2` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `phone3` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `code`, `name`, `username`, `email`, `password`, `role`, `address1`, `address2`, `city`, `province`, `country`, `phone1`, `phone2`, `phone3`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ADM001', 'admin', 'admin', 'test1@test.com', '$2y$10$TLJJG80ZzOraKV1hM8EE7uH3WHT4yL9r26VZpATIrp/OURKBS68Tu', 'admin', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:47', '2017-11-05 01:38:47', '2017-11-05 01:38:47'),
(2, 'ADM002', 'admin 2', 'admin2', 'tesla@test.com', '$2y$10$IJZ79N9T4nZzKdkwCFAksu.LVwEiEWGrItDNZLIEXrUHfw//FJHEG', 'admin2', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:47', '2017-11-05 01:38:47', '2017-11-05 01:38:47'),
(3, 'ADM003', 'rintis', 'rintis', 'test6@test.com', '$2y$10$Ezvb4/s3DscbS7W1dJFjc.JVqe2oo4tMp45DqyQ3zVB0x8oeuzG3K', 'admin', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:47', '2017-11-05 01:38:47', '2017-11-05 01:38:47'),
(4, 'OP001', 'operation', 'operation', 'test2@test.com', '$2y$10$xBbBNro.BnYEqBQ9hYBY4esNvsPIKOGm2w7kzTEPytOJy1Fa5DHIG', 'operation', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:47', '2017-11-05 01:38:47', '2017-11-05 01:38:47'),
(5, 'OP002', 'operation2', 'operation2', 'test222@test.com', '$2y$10$fzJcE2tuUy.ZJOJ9m7cLrOF82nUQY0MpLMyV6Oet90yKwyBBiECwi', 'operation', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:47', '2017-11-05 01:38:47', '2017-11-05 01:38:47'),
(6, 'PR001', 'pricing', 'pricing', 'test4@test.com', '$2y$10$sZmphfT7ICKmZEklL3b1MeI4ZnEtaJ4MOx0Stf61ggJ/OONGg.wJi', 'pricing', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:48', '2017-11-05 01:38:48', '2017-11-05 01:38:48'),
(7, 'PR002', 'pricing2', 'pricing2', 'test444@test.com', '$2y$10$kgAIQGwf.eHfY9nF7nvDkO7JuHfAJLhOhM9GugbuQkpFzrKeYwtYm', 'pricing', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:48', '2017-11-05 01:38:48', '2017-11-05 01:38:48'),
(8, 'INV001', 'invoice', 'invoice', 'test5@test.com', '$2y$10$T46.YJgVCMMUTk9RuXC1M.QrUNuUsEYymobhhYLSgUsNjZ6p/RyeG', 'invoice', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:48', '2017-11-05 01:38:48', '2017-11-05 01:38:48'),
(9, 'INV002', 'invoice2', 'invoice2', 'test555@test.com', '$2y$10$Dnyx8JE5.uL1Xz2vtcWkHOP4FRCaRZnTlZh0vW2HcwlUAgjF40gSS', 'invoice', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:48', '2017-11-05 01:38:48', '2017-11-05 01:38:48'),
(10, 'PAY001', 'payable', 'payable', 'test7@test.com', '$2y$10$lmiFHkDaA6XFVJ1qrDHYSuzXOeZyevubjfC3DMDCuEECD3FMHxwVm', 'payable', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:48', '2017-11-05 01:38:48', '2017-11-05 01:38:48'),
(11, 'PAY002', 'payable2', 'payable2', 'test777@test.com', '$2y$10$IEHdlMa2COE0RLFiBmsze.zyoS5ASdBn26Rnxp9N4VfeVO4DW0HNG', 'payable', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:48', '2017-11-05 01:38:48', '2017-11-05 01:38:48'),
(12, 'MRK001', 'ANITA', 'anita', 'test3@test.com', '$2y$10$1L.T9730AbZsm7jmRcyumOENUODZy2FU6zKQq5hMnYfPswOo/hqES', 'marketing', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:48', '2017-11-05 01:38:48', '2017-11-05 01:38:48'),
(13, 'MRK002', 'DEVITA', 'devita', 'test30@gex.com', '$2y$10$5Hkd8MFa65YqNiuq9Yl.ZunmEOX357peC2Iqb0vHfL342ZQqO2IKS', 'marketing', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:48', '2017-11-05 01:38:48', '2017-11-05 01:38:48'),
(14, 'MRK003', 'DIAH', 'diah', 'test31@test.com', '$2y$10$5p6ZR.pboWCtUZxNFeJTLupk0YDXqrZpZYh04oEWygMdZ6AavDw06', 'marketing', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:49', '2017-11-05 01:38:49', '2017-11-05 01:38:49'),
(15, 'MRK004', 'TRIANA', 'triana', 'test32@test.com', '$2y$10$uLOhcRhAH6YIHMAGFpcK2eFrPcJTIpgtZ0YIc7ULLq6plONvp5yOe', 'marketing', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:49', '2017-11-05 01:38:49', '2017-11-05 01:38:49'),
(16, 'MRK005', 'SYINDI', 'syindi', 'test33@test.com', '$2y$10$sq15xdeZwrxTRTszu55bCORD2XMnUykEPq8Bbqwt51QWaQpTmayH2', 'marketing', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:49', '2017-11-05 01:38:49', '2017-11-05 01:38:49'),
(17, 'MRK006', 'TRIYAWATI', 'triyawati', 'test34@test.com', '$2y$10$buf.NmgdSiZ23vd.8qZhKOKbqJSNG0LwMdXgc0.8Jid9RJO5tMKtG', 'marketing', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:49', '2017-11-05 01:38:49', '2017-11-05 01:38:49'),
(18, 'MRK007', 'DEWI', 'dewi', 'test35@test.com', '$2y$10$AlfHWghKBevv3/P13nlcHebqUN381LBxEzTwKIOBhvSA1iBcMZmGa', 'marketing', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:49', '2017-11-05 01:38:49', '2017-11-05 01:38:49'),
(19, 'MRK008', 'JOHAN', 'johan', 'test36@test.com', '$2y$10$dj3UW3bBHNB0Yqnp6wQmG.iUQg0H92LgBrjsEZM5jIy1KapKVlBeu', 'marketing', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:49', '2017-11-05 01:38:49', '2017-11-05 01:38:49'),
(20, 'MRK009', 'VINSEN', 'vinsen', 'test37@test.com', '$2y$10$6Ft9H.h/cp5hVWhr11nh/.PHIA.EU1.xg0cQV2wmuF1ZTBkrDb70S', 'marketing', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:49', '2017-11-05 01:38:49', '2017-11-05 01:38:49'),
(21, 'MRK010', 'IIN', 'iin', 'test38@test.com', '$2y$10$Dyox9lnLClMiST5IBM86Ae41LKsVCUaoGbfTQgIj6INO1Kfb/jLVa', 'marketing', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:49', '2017-11-05 01:38:49', '2017-11-05 01:38:49'),
(22, 'MRK011', 'WINA', 'wina', 'test39@test.com', '$2y$10$.OG3ITr/c1/3vMVSiwvEX.5j1D/9hs41lVzU05o1ym5Qk0SLivlGi', 'marketing', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:50', '2017-11-05 01:38:50', '2017-11-05 01:38:50'),
(23, 'MRK012', 'RIRI', 'riri', 'test310@test.com', '$2y$10$8wDEp6i5DzzeF7bqR1ibE.sYjI4.JxeHZFEUkJK0xRhSxJb1awTA6', 'marketing', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:50', '2017-11-05 01:38:50', '2017-11-05 01:38:50'),
(24, 'APP001', 'app', 'apppay', 'test41@test.com', '$2y$10$6b4E7uLOs75I0mdwqogE9u.b5uPEw5hQkALZElJGXmx9A7mARTlsS', 'manager', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:50', '2017-11-05 01:38:50', '2017-11-05 01:38:50'),
(25, 'APP002', 'app2', 'apppay2', 'test411@test.com', '$2y$10$G22RUZ3s3VSpYhTcmEWQa.bYf9jwBiBRmAz0cAg9t7iiFKeb1uGfy', 'manager', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:50', '2017-11-05 01:38:50', '2017-11-05 01:38:50'),
(26, 'PJK001', 'pajak', 'pajak', 'test42@test.com', '$2y$10$VQh7nfeQvYobmyOwGnQRc.o7/iCWtkDPwnHK1pL/xGVZOlSCeqkH6', 'pajak', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:50', '2017-11-05 01:38:50', '2017-11-05 01:38:50'),
(27, 'PJK002', 'pajak2', 'pajak2', 'test422@test.com', '$2y$10$hdv6cKCkgUJlIrzwkEjcOeCVU3aCd7EnUKRzWqT48Ww/0Dsr33jzq', 'pajak', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:50', '2017-11-05 01:38:50', '2017-11-05 01:38:50'),
(28, 'RPAY001', 'receivable', 'receivable', 'test51@test.com', '$2y$10$nnsw/wbrWo6sFUlG.eQ8LewbWaHIhPFzR.B2NcD/71rmsKWR6N2nq', 'receivable', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:50', '2017-11-05 01:38:50', '2017-11-05 01:38:50'),
(29, 'APR001', 'apr', 'apprec', 'test523@test.com', '$2y$10$AotEMsbdCfOxfDkAVZ.AS.cyTbETNO9ZErPumYD.EHpLWz1J1m4zm', 'approverec', NULL, NULL, '', '', '', '', '', '', NULL, '2017-11-05 01:38:50', '2017-11-05 01:38:50', '2017-11-05 01:38:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_code_unique` (`code`),
  ADD KEY `invoices_customer_id_index` (`customer_id`),
  ADD KEY `invoices_jobsheet_id_index` (`jobsheet_id`),
  ADD KEY `invoices_bank_id_index` (`bank_id`);

--
-- Indexes for table `invoice_documents`
--
ALTER TABLE `invoice_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_documents_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `jobsheets`
--
ALTER TABLE `jobsheets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jobsheets_code_unique` (`code`),
  ADD KEY `jobsheets_operation_id_foreign` (`operation_id`),
  ADD KEY `jobsheets_marketing_id_foreign` (`marketing_id`),
  ADD KEY `jobsheets_poo_id_foreign` (`poo_id`),
  ADD KEY `jobsheets_pod_id_foreign` (`pod_id`),
  ADD KEY `jobsheets_party_unit_id_foreign` (`party_unit_id`),
  ADD KEY `jobsheets_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `marketings`
--
ALTER TABLE `marketings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marketings_jobsheet_id_foreign` (`jobsheet_id`),
  ADD KEY `marketings_term_id_foreign` (`term_id`),
  ADD KEY `marketings_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `master_banks`
--
ALTER TABLE `master_banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_currencies`
--
ALTER TABLE `master_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_customers`
--
ALTER TABLE `master_customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_customers_nick_name_unique` (`nick_name`),
  ADD KEY `master_customers_code_index` (`code`);

--
-- Indexes for table `master_documents`
--
ALTER TABLE `master_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_documents_code_index` (`code`);

--
-- Indexes for table `master_ports`
--
ALTER TABLE `master_ports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_ports_code_index` (`code`);

--
-- Indexes for table `master_rates`
--
ALTER TABLE `master_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_roles`
--
ALTER TABLE `master_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_roles_name_unique` (`name`);

--
-- Indexes for table `master_terms`
--
ALTER TABLE `master_terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_units`
--
ALTER TABLE `master_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_vendors`
--
ALTER TABLE `master_vendors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_vendors_code_index` (`code`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payables`
--
ALTER TABLE `payables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payables_user_id_foreign` (`user_id`),
  ADD KEY `payables_jobsheet_id_foreign` (`jobsheet_id`),
  ADD KEY `payables_document_id_foreign` (`document_id`),
  ADD KEY `payables_vendor_id_foreign` (`vendor_id`),
  ADD KEY `payables_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `payment_docs`
--
ALTER TABLE `payment_docs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_docs_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `rc`
--
ALTER TABLE `rc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rc_jobsheet_id_foreign` (`jobsheet_id`),
  ADD KEY `rc_rc_document_id_foreign` (`rc_document_id`),
  ADD KEY `rc_rc_vendor_id_foreign` (`rc_vendor_id`),
  ADD KEY `rc_rc_unit_id_foreign` (`rc_unit_id`);

--
-- Indexes for table `receivables`
--
ALTER TABLE `receivables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receivables_jobsheet_id_foreign` (`jobsheet_id`),
  ADD KEY `receivables_rec_marketing_id_foreign` (`rec_marketing_id`),
  ADD KEY `receivables_rec_invoice_id_foreign` (`rec_invoice_id`),
  ADD KEY `receivables_rec_document_id_foreign` (`rec_document_id`),
  ADD KEY `receivables_rec_unit_id_foreign` (`rec_unit_id`);

--
-- Indexes for table `receivable_payments`
--
ALTER TABLE `receivable_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receivable_payments_customer_id_foreign` (`customer_id`),
  ADD KEY `receivable_payments_invoice_id_foreign` (`invoice_id`),
  ADD KEY `receivable_payments_jobsheet_id_foreign` (`jobsheet_id`);

--
-- Indexes for table `references`
--
ALTER TABLE `references`
  ADD PRIMARY KEY (`id`),
  ADD KEY `references_jobsheet_id_foreign` (`jobsheet_id`),
  ADD KEY `references_document_id_foreign` (`document_id`);

--
-- Indexes for table `reimbursements`
--
ALTER TABLE `reimbursements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reimbursements_jobsheet_id_foreign` (`jobsheet_id`),
  ADD KEY `reimbursements_rmb_marketing_id_foreign` (`rmb_marketing_id`),
  ADD KEY `reimbursements_rmb_unit_id_foreign` (`rmb_unit_id`),
  ADD KEY `reimbursements_rmb_document_id_foreign` (`rmb_document_id`),
  ADD KEY `reimbursements_rmb_invoice_id_foreign` (`rmb_invoice_id`),
  ADD KEY `reimbursements_rmb_vendor_id_foreign` (`rmb_vendor_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requests_jobsheet_id_foreign` (`jobsheet_id`),
  ADD KEY `requests_bank_id_foreign` (`bank_id`),
  ADD KEY `requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `revisions`
--
ALTER TABLE `revisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `revisions_jobsheet_id_foreign` (`jobsheet_id`),
  ADD KEY `revisions_sender_foreign` (`sender`),
  ADD KEY `revisions_receiver_foreign` (`receiver`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_code_unique` (`code`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_documents`
--
ALTER TABLE `invoice_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobsheets`
--
ALTER TABLE `jobsheets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketings`
--
ALTER TABLE `marketings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_banks`
--
ALTER TABLE `master_banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_currencies`
--
ALTER TABLE `master_currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_customers`
--
ALTER TABLE `master_customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `master_documents`
--
ALTER TABLE `master_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=700;

--
-- AUTO_INCREMENT for table `master_ports`
--
ALTER TABLE `master_ports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `master_rates`
--
ALTER TABLE `master_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_roles`
--
ALTER TABLE `master_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `master_terms`
--
ALTER TABLE `master_terms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `master_units`
--
ALTER TABLE `master_units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `master_vendors`
--
ALTER TABLE `master_vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payables`
--
ALTER TABLE `payables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_docs`
--
ALTER TABLE `payment_docs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rc`
--
ALTER TABLE `rc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receivables`
--
ALTER TABLE `receivables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receivable_payments`
--
ALTER TABLE `receivable_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `references`
--
ALTER TABLE `references`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reimbursements`
--
ALTER TABLE `reimbursements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `revisions`
--
ALTER TABLE `revisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `master_banks` (`id`),
  ADD CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `master_customers` (`id`),
  ADD CONSTRAINT `invoices_jobsheet_id_foreign` FOREIGN KEY (`jobsheet_id`) REFERENCES `jobsheets` (`id`);

--
-- Ketidakleluasaan untuk tabel `invoice_documents`
--
ALTER TABLE `invoice_documents`
  ADD CONSTRAINT `invoice_documents_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`);

--
-- Ketidakleluasaan untuk tabel `jobsheets`
--
ALTER TABLE `jobsheets`
  ADD CONSTRAINT `jobsheets_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `master_customers` (`id`),
  ADD CONSTRAINT `jobsheets_marketing_id_foreign` FOREIGN KEY (`marketing_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `jobsheets_operation_id_foreign` FOREIGN KEY (`operation_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `jobsheets_party_unit_id_foreign` FOREIGN KEY (`party_unit_id`) REFERENCES `master_units` (`id`),
  ADD CONSTRAINT `jobsheets_pod_id_foreign` FOREIGN KEY (`pod_id`) REFERENCES `master_ports` (`id`),
  ADD CONSTRAINT `jobsheets_poo_id_foreign` FOREIGN KEY (`poo_id`) REFERENCES `master_ports` (`id`);

--
-- Ketidakleluasaan untuk tabel `marketings`
--
ALTER TABLE `marketings`
  ADD CONSTRAINT `marketings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `master_customers` (`id`),
  ADD CONSTRAINT `marketings_jobsheet_id_foreign` FOREIGN KEY (`jobsheet_id`) REFERENCES `jobsheets` (`id`),
  ADD CONSTRAINT `marketings_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `master_terms` (`id`);

--
-- Ketidakleluasaan untuk tabel `payables`
--
ALTER TABLE `payables`
  ADD CONSTRAINT `payables_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `master_documents` (`id`),
  ADD CONSTRAINT `payables_jobsheet_id_foreign` FOREIGN KEY (`jobsheet_id`) REFERENCES `jobsheets` (`id`),
  ADD CONSTRAINT `payables_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `master_units` (`id`),
  ADD CONSTRAINT `payables_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payables_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `master_vendors` (`id`);

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `master_vendors` (`id`);

--
-- Ketidakleluasaan untuk tabel `payment_docs`
--
ALTER TABLE `payment_docs`
  ADD CONSTRAINT `payment_docs_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`);

--
-- Ketidakleluasaan untuk tabel `rc`
--
ALTER TABLE `rc`
  ADD CONSTRAINT `rc_jobsheet_id_foreign` FOREIGN KEY (`jobsheet_id`) REFERENCES `jobsheets` (`id`),
  ADD CONSTRAINT `rc_rc_document_id_foreign` FOREIGN KEY (`rc_document_id`) REFERENCES `master_documents` (`id`),
  ADD CONSTRAINT `rc_rc_unit_id_foreign` FOREIGN KEY (`rc_unit_id`) REFERENCES `master_units` (`id`),
  ADD CONSTRAINT `rc_rc_vendor_id_foreign` FOREIGN KEY (`rc_vendor_id`) REFERENCES `master_vendors` (`id`);

--
-- Ketidakleluasaan untuk tabel `receivables`
--
ALTER TABLE `receivables`
  ADD CONSTRAINT `receivables_jobsheet_id_foreign` FOREIGN KEY (`jobsheet_id`) REFERENCES `jobsheets` (`id`),
  ADD CONSTRAINT `receivables_rec_document_id_foreign` FOREIGN KEY (`rec_document_id`) REFERENCES `master_documents` (`id`),
  ADD CONSTRAINT `receivables_rec_invoice_id_foreign` FOREIGN KEY (`rec_invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `receivables_rec_marketing_id_foreign` FOREIGN KEY (`rec_marketing_id`) REFERENCES `marketings` (`id`),
  ADD CONSTRAINT `receivables_rec_unit_id_foreign` FOREIGN KEY (`rec_unit_id`) REFERENCES `master_units` (`id`);

--
-- Ketidakleluasaan untuk tabel `receivable_payments`
--
ALTER TABLE `receivable_payments`
  ADD CONSTRAINT `receivable_payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `master_customers` (`id`),
  ADD CONSTRAINT `receivable_payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `receivable_payments_jobsheet_id_foreign` FOREIGN KEY (`jobsheet_id`) REFERENCES `jobsheets` (`id`);

--
-- Ketidakleluasaan untuk tabel `references`
--
ALTER TABLE `references`
  ADD CONSTRAINT `references_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `master_documents` (`id`),
  ADD CONSTRAINT `references_jobsheet_id_foreign` FOREIGN KEY (`jobsheet_id`) REFERENCES `jobsheets` (`id`);

--
-- Ketidakleluasaan untuk tabel `reimbursements`
--
ALTER TABLE `reimbursements`
  ADD CONSTRAINT `reimbursements_jobsheet_id_foreign` FOREIGN KEY (`jobsheet_id`) REFERENCES `jobsheets` (`id`),
  ADD CONSTRAINT `reimbursements_rmb_document_id_foreign` FOREIGN KEY (`rmb_document_id`) REFERENCES `master_documents` (`id`),
  ADD CONSTRAINT `reimbursements_rmb_invoice_id_foreign` FOREIGN KEY (`rmb_invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `reimbursements_rmb_marketing_id_foreign` FOREIGN KEY (`rmb_marketing_id`) REFERENCES `marketings` (`id`),
  ADD CONSTRAINT `reimbursements_rmb_unit_id_foreign` FOREIGN KEY (`rmb_unit_id`) REFERENCES `master_units` (`id`),
  ADD CONSTRAINT `reimbursements_rmb_vendor_id_foreign` FOREIGN KEY (`rmb_vendor_id`) REFERENCES `master_vendors` (`id`);

--
-- Ketidakleluasaan untuk tabel `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `master_banks` (`id`),
  ADD CONSTRAINT `requests_jobsheet_id_foreign` FOREIGN KEY (`jobsheet_id`) REFERENCES `jobsheets` (`id`),
  ADD CONSTRAINT `requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `revisions`
--
ALTER TABLE `revisions`
  ADD CONSTRAINT `revisions_jobsheet_id_foreign` FOREIGN KEY (`jobsheet_id`) REFERENCES `jobsheets` (`id`),
  ADD CONSTRAINT `revisions_receiver_foreign` FOREIGN KEY (`receiver`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `revisions_sender_foreign` FOREIGN KEY (`sender`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
