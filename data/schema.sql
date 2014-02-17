CREATE TABLE IF NOT EXISTS `notes` ( 
  `note_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `note_title` varchar(80) NOT NULL,
  `note_body` text NOT NULL,
  `user_id` int,
  PRIMARY KEY (`note_id`),
  FOREIGN KEY (`user_id`) REFERENCES user(`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
INSERT INTO `notes` (`note_id`, `created_at`, `note_title`, `note_body`, `user_id`) VALUES
(1, '2013-11-04 00:00:00', 'First note', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc id sollicitudin magna, sed vehicula mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent varius semper ligula. Morbi vel risus blandit mauris pulvinar viverra vitae ut sem. Duis a eros porta, convallis quam non, pellentesque mauris. Maecenas tincidunt, tellus vel imperdiet dapibus, dui lectus scelerisque magna, sed feugiat enim metus nec lectus. Sed sed est dapibus, vulputate dolor id, fermentum sapien. Aenean rhoncus, neque sit amet fermentum tristique, felis enim bibendum enim, ut consectetur est metus sed urna. Curabitur molestie ullamcorper mi egestas consequat. Vestibulum nec leo arcu.', 2),
(2, '2013-11-04 00:00:00', 'Second note', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc id sollicitudin magna, sed vehicula mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent varius semper ligula. Morbi vel risus blandit mauris pulvinar viverra vitae ut sem. Duis a eros porta, convallis quam non, pellentesque mauris. Maecenas tincidunt, tellus vel imperdiet dapibus, dui lectus scelerisque magna, sed feugiat enim metus nec lectus. Sed sed est dapibus, vulputate dolor id, fermentum sapien. Aenean rhoncus, neque sit amet fermentum tristique, felis enim bibendum enim, ut consectetur est metus sed urna. Curabitur molestie ullamcorper mi egestas consequat. Vestibulum nec leo arcu.', 2),
(3, '2014-01-04 00:07:00', 'Asd note', 'ASD Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc id sollicitudin magna, sed vehicula mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent varius semper ligula. Morbi vel risus blandit mauris pulvinar viverra vitae ut sem. Duis a eros porta, convallis quam non, pellentesque mauris. Maecenas tincidunt, tellus vel imperdiet dapibus, dui lectus scelerisque magna, sed feugiat enim metus nec lectus. Sed sed est dapibus, vulputate dolor id, fermentum sapien. Aenean rhoncus, neque sit amet fermentum tristique, felis enim bibendum enim, ut consectetur est metus sed urna. Curabitur molestie ullamcorper mi egestas consequat. Vestibulum nec leo arcu.', 1)
CREATE TABLE IF NOT EXISTS `contacts` ( 
  `contact_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `contact_name` char(30) NOT NULL,
  `contact_surname` char(50) NOT NULL,
  `contact_street` varchar(60) NULL,
  `contact_city` char(40) NULL,
  `contact_postal_code` varchar(10) NULL,
  `contact_country` char(40) NULL,
  `contact_description` text(300) NULL,
  `contact_phone` varchar(20) NULL,
  `contact_phone2` varchar(20) NULL,
  `contact_photo` varchar(200) NULL,
  `contact_email` varchar(80) NULL,
  `contact_facebook` varchar(200) NULL,
  `contact_google` varchar(200) NULL,
  `user_id` int,
  PRIMARY KEY (`contact_id`),
  FOREIGN KEY (`user_id`) REFERENCES user(`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
INSERT INTO `contacts` (`contact_id`, `created_at`, `contact_name`, `contact_surname`, `contact_street`, `contact_city`, `contact_postal_code`, `contact_country`, `contact_description`, `contact_phone`, `contact_phone2`, `contact_photo`, `contact_email`, `contact_facebook`,`contact_google`,  `user_id`) VALUES
(1, '2013-11-04 00:00:00', 'Iza', 'Prokopek', 'Piotrkowska 17/19', 'Lodz', '90-406', 'Polska', 'Moja dziewczyna z Tarnowa, ale mieszka w Lodzi.', '600-300-200', '', '', 'iza@prokopek.pl', '', '', 2)
