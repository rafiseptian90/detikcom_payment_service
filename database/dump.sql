-- -------------------------------------------------------------
-- TablePlus 5.3.4(492)
--
-- https://tableplus.com/
--
-- Database: detikcom_payment
-- Generation Time: 2023-03-12 11:37:50.6270
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` char(36) COLLATE utf8mb4_general_ci NOT NULL DEFAULT (uuid()),
  `invoice_id` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `merchant_id` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `references_id` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `number_va` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `amount` bigint NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `payment_type` enum('credit_card','virtual_account') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'credit_card',
  `status` tinyint NOT NULL DEFAULT '2',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice_id` (`invoice_id`),
  UNIQUE KEY `references_id` (`references_id`),
  UNIQUE KEY `number_va` (`number_va`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `transactions` (`id`, `invoice_id`, `merchant_id`, `references_id`, `number_va`, `item_name`, `amount`, `customer_name`, `payment_type`, `status`, `created_at`, `updated_at`) VALUES
('28f97c93-c08c-11ed-90bf-0242ac110007', 'demo_zZt4uvXnM1TyOnrX', 'demo_merchant_0ethtA77Jmmux92X', 'demo_6090391404324', '657979473514746', 'iPhone 12 Pro Max', 15000000, 'Rafi Septian Hadi', 'credit_card', 2, '2023-03-12 04:12:53', '2023-03-12 04:12:53');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;