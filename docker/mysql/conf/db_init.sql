CREATE TABLE `books` (
  `uuid` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `author_uuid` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `authors` (
  `uuid` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE books ADD CONSTRAINT books_FK FOREIGN KEY (author_uuid) REFERENCES authors(uuid);


INSERT INTO authors VALUES ('99f951bf-7d49-4a1a-9152-7bdee1f5ce2e', 'Solaire', 'De astora');
INSERT INTO authors VALUES ('70f066f6-1cb7-4c45-97e2-287f0258ba02', 'Max', 'Payne');
