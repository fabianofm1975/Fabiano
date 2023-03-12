CREATE TABLE 'address_book' (
  'id' bigserial NOT NULL primary key,
  'name' varchar(255) NOT NULL,
  'email' varchar(255) NOT NULL,
  'tel' varchar(255) NOT NULL,
  'address' text NOT NULL
);

