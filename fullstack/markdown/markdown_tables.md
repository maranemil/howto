

######
## markdown tables
######
```
https://www.tablesgenerator.com/markdown_tables
https://www.markdownguide.org/extended-syntax/
https://www.makeuseof.com/tag/create-markdown-table/
https://www.ssc.wisc.edu/~hemken/Stataworkshops/stmd/Markdown/tables.md
```

```
pipe (|) character separates the individual columns in a table.
(-) hyphens act as a delimiter row to separate the header row from the body.
(:) colon to align cell contents.
```
~~~~
|     |     |     |     |     |
|:----|:----|:----|:----|:----|
|     |     |     |     |     |
|     |     |     |     |     |
|     |     |     |     |     |
~~~~

### add colored syntax

```bash
 curl --request GET \
      -H "Api-Token: YOUR_TOKEN"  \
       https://account.example.com/api/3/
```

```
https://www.ssc.wisc.edu/~hemken/Stataworkshops/stmd/Markdown/tables.md
https://github.com/kaushalmodi/ox-hugo/tree/main/test/site/content/posts
```

~~~~
| Column One    | Column Two    |
| ---           | ---           |
| data cell one | data cell two |
~~~~

<style>
table {
    border-collapse: collapse;
}
table, th, td {
   border: 1px solid black;
}
blockquote {
    border-left: solid blue;
	padding-left: 10px;
}
</style>

# Markdown Table Basic Examples
## Using *Flexmark* in Stata

### Doug Hemken
### May 2018


**Flexmark** extends the basic Markdown specification with the
addition of \"piped\" tables, an additional block element.  Inline
elements may be included within a table, but not other block 
elements.

## A Table, or Not?
A *table* is an arrangement of data in rows and columns, consisting of a
header row, a delimiter row separating the header from the data, and
data rows.  In *flexmark* it is possible to have a table that displays
as purely a header row, or a table that displays purely as data rows - each
is marked with a delimiter row.

Each row consists of cells containing arbitrary text, in which inlines are
parsed, separated by pipes (`|`).  A leading and trailing pipe is also
recommended for clarity of reading.

The delimiter row consists of cells (separated by pipes)
whose only content are hyphens (`-`) (at least three, like a theme break),
or optionally, a leading or trailing colon (`:`), or both, to indicate left,
right, or center alignment respectively.  Left justification is the
default for data cells, centered for header cells.

~~~~
```
| Column One    | Column Two    |
| ---           | ---           |
| data cell one | data cell two |
```
~~~~
| Column One    | Column Two    |
| ---           | ---           |
| data cell one | data cell two |

No delimter row or too few hyphens and this is no longer a table:
~~~~
```
| Column One    | Column Two    |
| data cell one | data cell two |

| Column One    | Column Two    |
| -             | --            |
| data cell one | data cell two |
```
~~~~
| Column One    | Column Two    |
| data cell one | data cell two |

| Column One    | Column Two    |
| -             | --            |
| data cell one | data cell two |

However, a table can have only a header row, or
only a data row:
~~~~
```
| Column One    | Column Two    |
| ---           | ---           |
```
~~~~
| Column One    | Column Two    |
| ---           | ---           |

~~~~
```
| ---           | ---           |
| data cell one | data cell two |
```
~~~~
| ---           | ---           |
| data cell one | data cell two |

* * * * *
In *flexmark*, one to three leading spaces are ignored.
~~~~
```
   | Column One    | Column Two    |
  | ---           | ---           |
 | data cell one | data cell two |
```

```
    | Column One | Column Two |
    | --- | --- |
    | data cell one | data cell two |
```
~~~~
    | Column One | Column Two |
    | --- | --- |
    | data cell one | data cell two |

* * * * *
Cells in the same column don't need to match length, though it's easier to read if
they do. Likewise, use of leading and trailing pipes may be inconsistent:

~~~~
```
| abc | defghi |
:-: | -----------:
data cell | data cell two
```
~~~~
| abc | defghi |
:-: | -----------:
data cell | data cell two

Include a pipe in a cell's content by escaping it, including inside other
inline spans:

~~~~
```
| f\|oo  |
| ------ |
| b `\|` az |
| b **\|** im |
```
~~~~
| f\|oo  |
| ------ |
| b `\|` az |
| b **\|** im |

* * * * *
The table is broken at the first empty line, or beginning of another
block-level structure:

~~~~
```
| abc | def |
| --- | --- |
| Column Two | data cell one |
> Column Two
```
~~~~
| abc | def |
| --- | --- |
| Column Two | data cell one |
> Column Two

Flexmark and pegdown interpret the first "Column Two" as a paragraph, while
GFM specifies it as a (short) table row/cell.  At least flexmark and
pegdown agree with each other.
~~~~
```
| abc | def |
| --- | --- |
| Column Two | data cell one |
Column Two

Column Two
```
~~~~
| abc | def |
| --- | --- |
| Column Two | data cell one |
Column Two

Column Two

In GFM, the header row must match the [delimiter row] in the number of cells.  If not,
a table will not be recognized.  However flexmark and pegdown both see this
as a table.

~~~~
```
| abc | def |
| --- |
| Column Two |
```
~~~~
| abc | def |
| --- |
| Column Two |

The remainder of the table's rows may vary in the number of cells.  In GFM, if there
are a number of cells fewer than the number of cells in the header row, empty
cells are inserted.  If there are greater, the excess is ignored.  In flexmark
and pegdown, the row with the greatest number of cells rules them all.

~~~~
```
| abc | def |
| --- | --- |
| Column Two |
| Column Two | data cell one | boo |
```
~~~~
| abc | def |
| --- | --- |
| Column Two |
| Column Two | data cell one | boo |

If there are no rows in the body, no `<tbody>` is generated in HTML output:
~~~~
```
| abc | def |
| --- | --- |
```
~~~~
| abc | def |
| --- | --- |

If there are no rows in the header, no visible header is generated in HTML output:
~~~~
```
| --- | --- |
| abc | def |
```
~~~~
| --- | --- |
| abc | def |

Examples not considered in the GFM extension.
Table in a blockquote? Yes.
~~~~
```
> sometext

> | Column One | Column Two |
> | --- | --- |
> | data cell one | data cell two |
```

```
> sometext

> | Column One | Column Two |
| --- | --- |
| data cell one | data cell two |
```
~~~~
> sometext

> | Column One | Column Two |
| --- | --- |
| data cell one | data cell two |

Table in a list?  Yes, a table may be a list item.
~~~~
```
- sometext

- | Column One | Column Two |
| --- | --- |
| data cell one | data cell two |
```
~~~~
- sometext

- | Column One | Column Two |
| --- | --- |
| data cell one | data cell two |

A table may also appear as a continuation of a list item.  Note there
are four leading spaces.
~~~~
```
- sometext

    | Column One | Column Two |
    | --- | --- |
    | data cell one | data cell two |
```

