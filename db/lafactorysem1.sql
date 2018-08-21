-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.19 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de la table alternateeve. email_template
DROP TABLE IF EXISTS `email_template`;
CREATE TABLE IF NOT EXISTS `email_template` (
  `email_template_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template_name` varchar(191) NOT NULL,
  `enable_sms` tinyint(4) DEFAULT '0',
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email_template_id`),
  KEY `idx_created_by` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Export de données de la table alternateeve.email_template : ~12 rows (environ)
DELETE FROM `email_template`;
/*!40000 ALTER TABLE `email_template` DISABLE KEYS */;
INSERT INTO `email_template` (`email_template_id`, `template_name`, `enable_sms`, `created_by`, `created_at`, `updated_at`) VALUES
	(1, 'signup_email', 0, 1, NULL, NULL),
	(2, 'signup_email_merchants', 0, 2, NULL, NULL),
	(3, 'Thankyou_command', 0, 2, NULL, NULL),
	(4, 'Command_status+affiliate links', 0, 2, NULL, NULL),
	(5, 'Purchase_demand_merchants', 0, 2, NULL, NULL),
	(6, 'Chose_your_merchants', 0, 2, NULL, NULL),
	(7, 'Message_selected_merchant+contact client', 0, 2, NULL, NULL),
	(8, 'Client_mail_after_choise', 0, 2, NULL, NULL),
	(9, 'Client_print_coupon', 0, 2, NULL, NULL),
	(10, 'after24h_coupon_renewal', 0, 2, NULL, NULL),
	(12, 'contact_us', 0, 1, NULL, NULL),
	(13, 'Ticket_system', 0, 2, NULL, NULL);
/*!40000 ALTER TABLE `email_template` ENABLE KEYS */;

-- Export de la structure de la table alternateeve. email_template_translation
DROP TABLE IF EXISTS `email_template_translation`;
CREATE TABLE IF NOT EXISTS `email_template_translation` (
  `email_template_translation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email_template_id` int(10) unsigned NOT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `content` text,
  `sms_content` longtext,
  `language_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`email_template_translation_id`),
  KEY `idx_email_template_id` (`email_template_id`),
  KEY `idx_language_id` (`language_id`),
  CONSTRAINT `email_template_translation_email_template` FOREIGN KEY (`email_template_id`) REFERENCES `email_template` (`email_template_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- Export de données de la table alternateeve.email_template_translation : ~24 rows (environ)
DELETE FROM `email_template_translation`;
/*!40000 ALTER TABLE `email_template_translation` DISABLE KEYS */;
INSERT INTO `email_template_translation` (`email_template_translation_id`, `email_template_id`, `subject`, `content`, `sms_content`, `language_id`) VALUES
	(1, 1, 'Welcome to Alternateeve!!', '<p><b></b><b>Welcome to Alternateeve!!</b><b></b><br></p><p>Thank to creating your account with <b></b>us</p><p>Bla bla bli bla bla blou fr<br></p><p><br></p><p>EN Si vous souhaitez plus d\'informations à propos du fonctionnement vous pouvez consulter notre section <a target="_blank" rel="nofollow" href="http://139.59.68.192/alternateeve/public/how-it-work">Fonctionnement</a> ou les <a target="_blank" rel="nofollow" href="http://139.59.68.192/alternateeve/public/faq">Questions Fréquemment posées</a><br></p>', NULL, 1),
	(2, 1, 'Bienvenue chez Alternateeve!!', '<p><b>Bienvenue chez Alternateeve!!</b><br></p><p>Merci d\'avoir créer votre compte.</p><p>Bla bla bli bla bla blou fr</p><p><br></p><p>Si vous souhaitez plus d\'informations à propos du fonctionnement vous pouvez consulter notre section <a target="_blank" rel="nofollow" href="http://139.59.68.192/alternateeve/public/how-it-work">Fonctionnement</a> ou les <a target="_blank" rel="nofollow" href="http://139.59.68.192/alternateeve/public/faq">Questions Fréquemment posées</a></p>', NULL, 2),
	(3, 2, 'Welcome to Alternateeve for business', '<p>Welcome to Alternateeve for business<br></p><p><br></p><p>test english</p>', NULL, 1),
	(4, 2, 'Bienvenue au programme Alternateeve pour les affaires', '<p>Bienvenue au programme Alternateeve pour les affaires<br></p><p><br></p><p>test francais</p>', NULL, 2),
	(5, 3, 'Thank you for your command', '<p>Thank you for your command<br></p>', NULL, 1),
	(6, 3, 'Merci d\'avoir passé votre commande', '<p>Merci d\'avoir passé votre commande<br></p>', NULL, 2),
	(7, 4, 'Availability of your command', '<p>Availability of your command<br></p><p>INSERT AFFILIATE LINKS HERE</p>', NULL, 1),
	(8, 4, 'Disponibilité de votre commande', '<p>Disponibilité de votre commande<br></p><p>INSERT AFFILIATE LINKS HERE<br></p>', NULL, 2),
	(9, 5, 'You have receipted a new demande of purchase', '<p>You have receipted a new demande of purchase<br></p><p><i>INSERT PRODUCTS INFORMATIONS HERE</i></p><p></p><p><i>LINKS TO ACTION:</i></p><p><i>- Sold the product (already available)</i></p><p><i></i></p><p><i><i>- Sold the product (available 24 to 72h)</i></i></p><p></p><i>- Product not available</i><p></p><p><i>- Don\'t sold (price problem)</i><br></p><br><p></p>', NULL, 1),
	(10, 5, 'Vous avez reçu une nouvelle demande d\'achat', '<p>Vous avez reçu une nouvelle demande d\'achat</p><p></p><p><i>INSERT PRODUCTS INFORMATIONS HERE</i></p><p></p><p><i>LINKS TO ACTION:</i></p><p><i>- Sold the product (already available)</i></p><p><i></i></p><p><i><i>- Sold the product (available 24 to 72h)</i></i></p><p></p><i>- Product not available</i><p></p><p><i>- Don\'t sold (price problem)</i></p><p></p><br><p></p>', NULL, 2),
	(11, 6, 'We found your product, choose where you will get it', '<p>We found your product, choose where you will get it<br></p><p>LINK TO THE STATUS PAGE</p>', NULL, 1),
	(12, 6, 'Nous avons trouvé votre achat, choisissez ou vous le recupererez', '<p>Nous avons trouvé votre achat, choisissez ou vous le recupererez<br></p><p>LINK TO THE STATUS PAGE<br></p>', NULL, 2),
	(13, 7, 'You sold a product! Client choose your shop', '<p>You sold a product! Client choose your shop<br></p><p>product sold</p><p>INCLUDE PRODUCT INFORMATIONS</p><p>(IF AVAILABLE): You can contact the client at PHONE NUMBER if you want to set the pickup in store</p>', NULL, 1),
	(14, 7, 'Vous venez de vendre un produit! Le client a choisi votre magasin', '<p>Vous venez de vendre un produit! Le client a choisi votre magasin<br></p><p>Produit vendu</p><p>INCLUDE PRODUCT INFORMATIONS<br></p><p>(IF AVAILABLE): Vous pouvez contacter le client au PHONE NUMBER si vous désirez parler du ramassage en magasin<br></p>', NULL, 2),
	(15, 8, 'You have chosen your shop. Please find your coupon attached', '<p>You have chosen your shop. Please find your coupon attached<br></p><p>LINK TO THE COUPON IN PDF INTO THE WEBSITE</p>', NULL, 1),
	(16, 8, 'Vous avec choisi votre magasin. Voici votre coupon d\'achat', '<p>Vous avec choisi votre magasin. Voici votre coupon d\'achat<br></p><p>LINK TO THE COUPON IN PDF INTO THE WEBSITE<br></p>', NULL, 2),
	(17, 9, 'Your client print the coupon.', '<p>Your client print the coupon. <br></p><p>This coupon is valid for the 24h. Be ready for his visit</p><p><i>LINKS TO ACTION:</i></p><p><i>- Validate the sale (product was pickup)</i></p><p><i>- Validate the sale (alternative product sold)</i></p><p><i>- Client came but didn\'t buy</i></p><p><i>- Client didn\'t came</i></p>', NULL, 1),
	(18, 9, 'Votre client a imprimé le coupon', '<p>Votre client a imprimé le coupon<br></p><p>Ce coupon est valide 24h. Préparez vous à sa visite.</p><p></p><p><i>LINKS TO ACTION:</i></p><p><i>- Validate the sale (product was pickup)</i></p><p><i>- Validate the sale (alternative product sold)</i></p><p><i>- Client came but didn\'t buy</i></p><p><i>- Client didn\'t came</i></p><br><p></p>', NULL, 2),
	(19, 10, 'Your coupon expired, get a new one to buy your product', '<p>Your coupon expired, get a new one to buy your product<br></p><p><i>LINK TO COUPON</i></p>', NULL, 1),
	(20, 10, 'Votre coupon a expiré, obtenez en un nouveau pour acheter votre produit', '<p>Votre coupon a expiré, obtenez en un nouveau pour acheter votre produit<br></p><p><i>LINK TO COUPON</i><br></p>', NULL, 2),
	(23, 12, 'Contact Us', '<p>Hi this is contact us email</p>\r\n\r\n<p>NAME : #NAME#</p>\r\n\r\n<p>EMAIL : #EMAIL#</p>\r\n\r\n<p>SUBJECT : #SUBJECT#</p>\r\n\r\n<p>MESSAGE : #MESSAGE#</p>\r\n\r\n<p>Thanks</p>', NULL, 1),
	(24, 12, 'Contact Us', '<p>Hi this is contact us email</p>\r\n\r\n<p>NAME : #NAME#</p>\r\n\r\n<p>EMAIL : #EMAIL#</p>\r\n\r\n<p>SUBJECT : #SUBJECT#</p>\r\n\r\n<p>MESSAGE : #MESSAGE#</p>\r\n\r\n<p>Thanks</p>', NULL, 2),
	(25, 13, 'Your ticket has been updated', NULL, NULL, 1),
	(26, 13, 'Votre ticket a été mis à jour', NULL, NULL, 2);
/*!40000 ALTER TABLE `email_template_translation` ENABLE KEYS */;

-- Export de la structure de la table alternateeve. email_template_variables
DROP TABLE IF EXISTS `email_template_variables`;
CREATE TABLE IF NOT EXISTS `email_template_variables` (
  `email_template_id` int(10) unsigned NOT NULL,
  `variable_name` varchar(191) NOT NULL,
  `variable_title` varchar(191) NOT NULL,
  KEY `idx_email_template_id` (`email_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table alternateeve.email_template_variables : ~4 rows (environ)
DELETE FROM `email_template_variables`;
/*!40000 ALTER TABLE `email_template_variables` DISABLE KEYS */;
INSERT INTO `email_template_variables` (`email_template_id`, `variable_name`, `variable_title`) VALUES
	(12, '#NAME#', 'NAME'),
	(12, '#EMAIL#', 'EMAIL'),
	(12, '#SUBJECT#', 'SUBJECT'),
	(12, '#MESSAGE#', 'MESSAGE');
/*!40000 ALTER TABLE `email_template_variables` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
