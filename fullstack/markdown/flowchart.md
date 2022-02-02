
## markdown mermaid flow chart

- https://www.jetbrains.com/help/idea/markdown.html#diagrams
- https://mermaid-js.github.io/mermaid/#/
- https://www.jetbrains.com/help/idea/markdown-reference.html
- https://plugins.jetbrains.com/plugin/7793-markdown
- https://docs.gitlab.com/ee/user/markdown.html


```mermaid
graph TD;
  A-->B;
  A-->C;
  B-->D;
  C-->D;
```


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

----------------------------------------------------
### Flowchart mermaid example


```mermaid
graph TD;
    A[squer]-->B(here we go);
    A-->|text|C((circle));
    B-->D;
    C-.->D;
    D{if}-->A;
```


 - https://mermaid-js.github.io/mermaid/#/flow
 - https://marketplace.visualstudio.com/items?itemName=bierner.markdown-mermaid