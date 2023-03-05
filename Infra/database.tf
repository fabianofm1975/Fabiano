resource "azurerm_postgresql_flexible_server_database" "db-automacao" {
  name      = "db-automacao"
  server_id = azurerm_postgresql_flexible_server.pg-automacao.id
  collation = "en_US.utf8"
  charset   = "utf8"
}

resource "azurerm_postgresql_flexible_server_database" "db-apresentacao" {
  name      = "db-apresentacao"
  server_id = azurerm_postgresql_flexible_server.pg-automacao.id
  collation = "en_US.utf8"
  charset   = "utf8"
}


resource "azurerm_postgresql_flexible_server_configuration" "pg-automacao-cfg" {
  name      = "azure.extensions"
  server_id = azurerm_postgresql_flexible_server.pg-automacao.id
  value     = "PGAUDIT,PG_STAT_STATEMENTS"

}

