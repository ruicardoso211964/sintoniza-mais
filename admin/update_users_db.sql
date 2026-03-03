ALTER TABLE `users`
ADD COLUMN `radio_name` varchar(100) DEFAULT NULL AFTER `approved`,
ADD COLUMN `radio_role` varchar(100) DEFAULT NULL AFTER `radio_name`,
ADD COLUMN `radio_website` varchar(255) DEFAULT NULL AFTER `radio_role`,
ADD COLUMN `interest_reason` text DEFAULT NULL AFTER `radio_website`,
ADD COLUMN `referral_source` varchar(100) DEFAULT NULL AFTER `interest_reason`;
