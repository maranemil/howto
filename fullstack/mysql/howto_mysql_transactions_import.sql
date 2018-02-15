
-- https://dev.mysql.com/doc/refman/5.7/en/comments.html
-- https://dev.mysql.com/doc/refman/5.7/en/mysqldump.html#option_mysqldump_compact
-- https://searchcode.com/codesearch/view/93975698/

-- [options] : --skip-add-drop-table --skip-add-locks --skip-disable-keys --skip-set-charset  --compact
-- [--compact] - Produce more compact output. This option enables the --skip-add-drop-table, --skip-add-locks, --skip-comments, --skip-disable-keys, and --skip-set-charset options.
--
-- conditional-execution tokens.
--

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */ to SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Test import / . In SQL file add: START TRANSACTION; and COMMIT; before import
-- mysqldump --single-transaction --insert-ignore --user dom_backend --password --host 1.1.1.1  --debug-info --verbose db table < table.sql