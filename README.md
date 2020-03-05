# gratka.pl/nieruchomosci PHP Parser
This parser download ALL data from [gratka.pl/nieruchomosci](https://gratka.pl/nieruchomosci) and save it in organized database.

### Configuration
Download repo, import to mysql file `database.sql` which is empty table structures.
Then edit database connection access in `connection.php` .

You can also change some variables at the beginning of  `download.php` file (for example `$pagesToUpdate` variable).

### Usage
Run `download.php` frequently (for example every 10 minutes). You should use *cron* for this.

### License
CC0 1.0 Universal (CC0 1.0) Public Domain Dedication

No Copyright, so you can copy, modify, distribute and perform the work, even for commercial purposes, all without asking permission. Learn more https://creativecommons.org/publicdomain/zero/1.0/deed

### Contributions
[PHP Simple HTML DOM Parser](https://simplehtmldom.sourceforge.io/)