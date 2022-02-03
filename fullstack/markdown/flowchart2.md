## graph flowchart

- https://docs.gitlab.com/ee/user/markdown.html
- https://jojozhuang.github.io/tutorial/mermaid-cheat-sheet/
- https://unpkg.com/mermaid@0.5.3/dist/www/flowchart.html#styling-and-classes
- https://www.rstudio.com/wp-content/uploads/2015/02/rmarkdown-cheatsheet.pdf


```mermaid
graph TB

  SubGraph1 --> SubGraph1Flow
  subgraph "SubGraph 1 Flow"
  SubGraph1Flow(SubNode 1)
  SubGraph1Flow -- Choice1 --> DoChoice1
  SubGraph1Flow -- Choice2 --> DoChoice2
  end

  subgraph "Main Graph"
  Node1[Node 1] --> Node2[Node 2]
  Node2 --> SubGraph1[Jump to SubGraph1]
  SubGraph1 --> FinalThing[Final Thing]
end
```


- https://rich-iannone.github.io/DiagrammeR/mermaid.html
- http://blockdiag.com/en/blockdiag/examples.html#edge-folding

```mermaid
graph LR
A-->B
A-->C
C-->E
B-->D
C-->D
D-->F
E-->F
```

```
Beta: flowcharts
```
https://mermaid-js.github.io/mermaid/#/flowchart?id=beta-flowcharts

```mermaid
flowchart TB
    c1-->a2
    subgraph one
    a1-->a2
    end
    subgraph two
    b1-->b2
    end
    subgraph three
    c1-->c2
    end
    one --> two
    three --> two
    two --> c2
    
```

https://michelf.ca/projects/php-markdown/extra/#fenced-code-blocks

```
css for mermaid

<style>
/*svg[id^="mermaid-"] { 
    min-width: 400px; max-width: 500px; max-height: 800px; font-size: 30px
     }
*/

/*.mermaid {width:200% !important}*/

/*svg[id^="m"][width][height][viewBox] {
    max-width: 95%;
    max-height: 95%;
}

div.mermaid {
    margin-left: 0 !important;
    text-align: center;
    resize:both;
    overflow:auto;
    margin-bottom: 2px;
    position:relative;
    max-height: 600px;
    max-width: 100%;
}

div.mermaid::after {
    content:'';
    display:block;
    width:10px;
    height:10px;
    background-color:yellowgreen;
    position:absolute;
    right:0;
    bottom:0;
}*/

/*.mermaid svg { 
  max-width: 100%; 
  height: 800px;
}
div.mermaid {
    text-align: center;
}*/

/*svg[id^="m"][width][height][viewBox] {
    width: auto;
    height: 800px;
}*/
</style>
```


```
https://rich-iannone.github.io/DiagrammeR/mermaid.html
sequenceDiagram
```

```mermaid
sequenceDiagram
  customer->>ticket seller: ask ticket
  ticket seller->>database: seats
  alt tickets available
    database->>ticket seller: ok
    ticket seller->>customer: confirm
    customer->>ticket seller: ok
    ticket seller->>database: book a seat
    ticket seller->>printer: print ticket
  else sold out
    database->>ticket seller: none left
    ticket seller->>customer: sorry
  end
```
```
</tyle>
    div.mermaid {
        filter: invert(1) !important;
        background: #115;
    }
</style>
```

-------------------------------------------------------------------


