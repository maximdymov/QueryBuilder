# QueryBuilder

This component simplifies CRUD operations.

## Create Object
```php 
db = new QueryBuilder(new PDO("mysql:host=localhost;dbname=YOUR_DB_NAME", "USERNAME", "ROOT"));
```
## Operations
```php 
all = db->getAll("TABLENAME");
one = db->getOne("TABLENAME", "ID");
db->create("TABLENAME", [data]);  // data is array with new record's info
db->update("TABLENAME", [data], "ID");  // data is array with updating record's info
db->delete("TABLENAME", "ID")
```
