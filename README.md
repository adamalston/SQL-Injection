# SQL Injection

[![License](https://img.shields.io/github/license/adamalston/SQL-Injection?color=critical)](LICENSE)

A SQL Injection attack consists of the insertion or injection of a SQL query via the input data from the client to the application. A successful SQL injection exploit can read sensitive data from the database, modify database data (Insert/Update/Delete), execute administration operations on the database (such as shutdown the DBMS), recover the content of a given file present on the DBMS file system and in some cases issue commands to the operating system. SQL injection attacks are a type of injection attack, in which SQL commands are injected into data-plane input to effect the execution of predefined SQL commands.

SQL injection attacks allow attackers to spoof identity, tamper with existing data, cause repudiation issues such as voiding transactions or changing balances, allow the complete disclosure of all data on the system, destroy the data or make it otherwise unavailable, and become administrators of the database server.

SQL injection is common with PHP (this repo has a php SQL injection implemtation) and ASP applications due to the prevalence of older functional interfaces. Due to the nature of programmatic interfaces available, J2EE and <span>ASP.NET</span> applications are less likely to have easily exploited SQL injections.

The severity of SQL injection attacks is limited by the attacker’s skill and imagination, and to a lesser extent, defense in depth countermeasures, such as low privilege connections to the database server and so on. In general, consider SQL injection a high impact severity.

## Example

Hospital database attack

SQL query:

```SQL
select ssn, firstname, lastname
from patients
```

The attacker then gives a malicious parameter (in this case, their firstname) in a client:

```SQL
Firstname: evil'ex
Lastname: newman
```

The query string becomes:

```SQL
select ssn, firstname, lastname
from patients
where firstname = "evil'ex" and lastname = "newman"
```

Which the database attempts to run:

```
Incorrect syntax near il' as the database tried to execute evil.
```

---

Includes decription snippets from OWASP on SQL Injections.

---

Thank you for your interest, this project was fun to work on!
