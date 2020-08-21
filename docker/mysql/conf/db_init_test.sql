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


INSERT INTO authors VALUES ('70f066f6-1cb7-4c45-97e2-287f0258ba02', 'Stub', 'Sub Surname');
INSERT INTO books VALUES ('b89021c3-8771-36a4-9d7d-5b39109b0ac5', '70f066f6-1cb7-4c45-97e2-287f0258ba02', 'stub test', 'stub test', 'stub test');
