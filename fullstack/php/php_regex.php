<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 22.10.15
 * Time: 19:01
 */

Examples:

$string = "B 344423";

$string1 = preg_replace("/[^a-zA-Z-]/", "", $string); // remove digits (0-9)
$string2 = preg_replace("/[^0-9]/","", $string); // remove letters (A-Z)

preg_match("/(\d+)/", $string, $match); // remove letters (A-Z)
$string3 = $match[1];

$string4 = preg_replace("/\d+/i", "", $string); // remove digits (0-9)
$string5 = preg_replace("/\D+/i", "", $string); // remove letters (A-Z)

/**

\ ^ . $ | ( ) [ ]
* + ? { } ,

Special Character Definitions
\ Quote the next metacharacter
^ Match the beginning of the line
. Match any character (except newline)
$ Match the end of the line (or before newline at the end)
| Alternation
() Grouping
[] Character class
* Match 0 or more times
+ Match 1 or more times
	? Match 1 or 0 times
{n} Match exactly n times
{n,} Match at least n times
{n,m} Match at least n but not more than m times
More Special Character Stuff
\t tab (HT, TAB)
\n newline (LF, NL)
\r return (CR)
\f form feed (FF)
\a alarm (bell) (BEL)
\e escape (think troff) (ESC)
\033 octal char (think of a PDP-11)
\x1B hex char
\c[ control char
\l lowercase next char (think vi)
\u uppercase next char (think vi)
\L lowercase till \E (think vi)
\U uppercase till \E (think vi)
\E end case modification (think vi)
\Q quote (disable) pattern metacharacters till \E
Even More Special Characters
\w Match a "word" character (alphanumeric plus "_")
\W Match a non-word character
\s Match a whitespace character
\S Match a non-whitespace character
\d Match a digit character
\D Match a non-digit character
\b Match a word boundary
\B Match a non-(word boundary)
\A Match only at beginning of string
\Z Match only at end of string, or before newline at the end
\z Match only at end of string
\G Match only where previous m//g left off (works only with /g)


http://www.craigsefton.com/programming/10-useful-php-string-related-functions/
 *
 * */

// http://stackoverflow.com/questions/709669/how-do-i-remove-blank-lines-from-text-in-php


// New line is required to split non-blank lines
preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $string);

/*
The above regular expression says:

/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/
    1st Capturing group (^[\r\n]*|[\r\n]+)
        1st Alternative: ^[\r\n]*
        ^ assert position at start of the string
[\r\n]* match a single character present in the list below
                Quantifier: Between zero and unlimited times, as many times as possible, giving back as needed [greedy]
                \r matches a carriage return (ASCII 13)
                \n matches a fine-feed (newline) character (ASCII 10)
        2nd Alternative: [\r\n]+
[\r\n]+ match a single character present in the list below
            Quantifier: Between one and unlimited times, as many times as possible, giving back as needed [greedy]
            \r matches a carriage return (ASCII 13)
            \n matches a fine-feed (newline) character (ASCII 10)
    [\s\t]* match a single character present in the list below
        Quantifier: Between zero and unlimited times, as many times as possible, giving back as needed [greedy]
        \s match any white space character [\r\n\t\f ]
        \tTab (ASCII 9)
    [\r\n]+ match a single character present in the list below
        Quantifier: Between one and unlimited times, as many times as possible, giving back as needed [greedy]
        \r matches a carriage return (ASCII 13)
        \n matches a fine-feed (newline) character (ASCII 10)
*/

