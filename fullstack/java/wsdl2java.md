
######
### JAX-WS : wsimport tool example
######
```
Command 'wsimport' not found, but can be installed with:

sudo apt install jaxws                   # version 2.3.0.2-1, or
sudo apt install openjdk-8-jdk-headless  # version 8u222-b10-1ubuntu1~19.04.1


https://www.mkyong.com/webservices/jax-ws/jax-ws-wsimport-tool-example/
https://docs.oracle.com/javase/8/docs/technotes/tools/unix/wsimport.html


https://help.eclipse.org/kepler/index.jsp?topic=%2Forg.eclipse.jst.ws.cxf.doc.user%2Freference%2Fwsdl2java_tab.html
https://help.eclipse.org/kepler/index.jsp?topic=%2Forg.eclipse.jst.ws.cxf.doc.user%2Ftasks%2Fcreate_client.html
https://stackoverflow.com/questions/3492257/how-to-write-a-java-client-to-access-wsdl-file/3493658#3493658

wsimport -keep -verbose http://compA.com/ws/server?wsdl
parsing WSDL...

generating code...
com\mkyong\ws\ServerInfo.java
com\mkyong\ws\ServerInfoImplService.java

/bin/wsimport.sh -help

wsimport -Xnocompile -keep -b binding.xml wsdlFile.wsdl
```