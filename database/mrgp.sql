-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.29-0ubuntu0.18.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping data for table mrgp.histories: ~1 rows (approximately)
/*!40000 ALTER TABLE `histories` DISABLE KEYS */;
INSERT IGNORE INTO `histories` (`id`, `patient_id`, `user_id`, `fever`, `bpressure`, `weight`, `pulse`, `complaint`, `diseases`, `remarks`, `treatplan`, `otherhistory`, `finding_phy`, `finding_dm`, `finding_lab`, `created_at`, `updated_at`, `res`, `xRayLink`, `mriLink`, `ctLink`, `usLink`, `bill`) VALUES
	(1, 1, 1, 'sdf', 'dfs', 'dfs', 'fds', 'fd', 'sadf', 'sdf', 'fds', 'fd', 'dsf', 'sfd', 'dfs', '2020-06-14 11:47:45', '2020-06-14 11:47:45', 'fds', '\\uploads\\images\\XRay\\2020-06-14STRNaW8IJc0TIda1.png', NULL, NULL, NULL, '33');
/*!40000 ALTER TABLE `histories` ENABLE KEYS */;

-- Dumping data for table mrgp.history: ~0 rows (approximately)
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
/*!40000 ALTER TABLE `history` ENABLE KEYS */;

-- Dumping data for table mrgp.items: ~0 rows (approximately)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Dumping data for table mrgp.migrations: ~8 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2018_03_22_033551_create_patients_table', 1),
	(4, '2018_04_09_041327_create_items_table', 1),
	(5, '2018_04_18_091545_create_history_table', 1),
	(6, '2018_04_20_152938_create_histories_table', 1),
	(10, '2020_06_14_074430_add_additional_info_to_patients_table', 2),
	(12, '2020_06_14_113742_add_additional_info_to_histories_table', 3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping data for table mrgp.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping data for table mrgp.patients: ~1 rows (approximately)
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT IGNORE INTO `patients` (`id`, `user_id`, `name`, `phone`, `gender`, `marriage`, `blood`, `bio`, `address`, `created_at`, `updated_at`, `imageLink`, `nid`, `dob`, `Dad`, `Mom`, `biosocial`) VALUES
	(1, 1, 'test', '999', 'Male', 'Single', 'O', 'sadf', 'dsf', '2020-06-14 11:23:37', '2020-06-14 11:23:37', NULL, NULL, '1991-06-02', 'test', 'test', NULL);
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;

-- Dumping data for table mrgp.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'initmyanmar', 'initmyanmar@gmail.com', '$2y$10$FSijXgJ8nT8xpbi.7Et5du1f1/tIR6jMdp/nCQydBv9nWk0oMuFoG', 'QqWlfEYMZ44VYttgrwfAf6dwmoVvI21ii3oMeJxQQluziOucQZBpSPmofszV', '2020-06-14 11:20:14', '2020-06-14 11:20:14');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
