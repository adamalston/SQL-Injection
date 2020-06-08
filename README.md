# SQL Injection

[![License](https://img.shields.io/github/license/adamalston/SQL-Injection?color=critical)](LICENSE)

A SQL Injection attack consists of the insertion or injection of a SQL query via the input data from the client to the application. A successful SQL injection exploit can read sensitive data from the database, modify database data (Insert/Update/Delete), execute administration operations on the database (such as shutdown the DBMS), recover the content of a given file present on the DBMS file system and in some cases issue commands to the operating system. SQL injection attacks are a type of injection attack, in which SQL commands are injected into data-plane input to affect the execution of predefined SQL commands.

SQL injection attacks allow attackers to spoof identity, tamper with existing data, cause repudiation issues such as voiding transactions or changing balances, allow the complete disclosure of all data on the system, destroy the data or make it otherwise unavailable, and become administrators of the database server.

SQL injection is common with PHP (this repo has a PHP SQL injection implementation) and ASP applications due to the prevalence of older functional interfaces. Due to the nature of programmatic interfaces available, Java and <span>ASP.NET</span> applications are less likely to have easily exploited SQL injections.

The severity of SQL injection attacks is limited by the attacker’s skill and imagination, and to a lesser extent, defense in depth countermeasures, such as low privilege connections to the database server and so on. In general, consider SQL injection a high impact severity.

## Examples

### Normal Backend Interaction

When prompted in an application, a user enters:

`username:` `JohnDoe`

`password:` `password`

The application processes the input:
```python
username = getRequestString("username")
password = getRequestString("userpassword")

sql = 'SELECT * FROM Users WHERE name ="' + username + '" AND pass = "' + password + '"'
```

Database query:

```sql
SELECT * FROM users WHERE name = "JohnDoe" AND pass = "password"
```

### Return the Entire Table

A malicious party may get access to usernames and passwords in a database by inserting `" OR ""="` into the user name or password text box:

A user enters:

`username:` `" OR ""="`

`password:` `" OR ""="`

Query becomes:

```SQL 
SELECT * FROM users WHERE name = "" OR ""="" AND pass = "" OR ""=""
```

This SQL statement will return all rows from the users table since `OR ""=""` always evaluates to true.

### Delete a Table Using a Batched SQL Statements

A user enters:

`username:` `coldfusion; DROP TABLE Suppliers`

`password:` `password`

Query becomes:

```sql
SELECT * FROM users WHERE username = "coldfusion"; DROP TABLE stockPortfolio;
```

This SQL statement will result in the permanent deletion (`DROP TABLE` is an automatically committed statement whereas `DELETE` is not and can be rolled back) of the stockPortfolio table's data and structure from the database.

## Prevention/Protection

SQL parameters can be used to protect a website from SQL injection. SQL parameters are values that are added to a SQL query at the time of execution.

```python
name = getRequestString("PatientName")
addr = getRequestString("Address")
city = getRequestString("City")
zipc = getRequestString("Zip")

txtSQL = "INSERT INTO Patients (PatientName,Address,City,Zip) Values(@0,@1,@2,@3)"

db.Execute(txtSQL,name,addr,city,zipc)
```

The SQL engine checks each parameter to ensure that it is valid for its column. All parameters are treated literally and not as part of the SQL to be executed.

In PHP:

```php
$stmt = $dbh->prepare("INSERT INTO Patients (PatientName,Address,City,Zip) VALUES (:name, :addr, :city, :zipc)");

$stmt->bindParam(':name', $name);
$stmt->bindParam(':addr', $addr);
$stmt->bindParam(':city', $city);
$stmt->bindParam(':zipc', $zipc);

$stmt->execute();
```

---

Includes decription snippets from OWASP on SQL Injections.

---

Thank you for your interest, this project was fun to work on!
