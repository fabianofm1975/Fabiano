CREATE TABLE `address_book` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `address_book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `name` (`name`),
  ADD KEY `tel` (`tel`);

ALTER TABLE `address_book`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;