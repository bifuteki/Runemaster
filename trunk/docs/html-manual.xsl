<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
                xmlns:fo="http://www.w3.org/1999/XSL/Format"   
                version="1.0">

  <xsl:import href="/usr/share/xml/docbook/stylesheet/nwalsh/html/chunk.xsl"/>

  <xsl:output method="html" encoding="UTF-8" indent="yes"/>

  <xsl:param name="use.id.as.filename">1</xsl:param>
  <xsl:param name="section.label.includes.component.label">1</xsl:param>
  <xsl:param name="section.autolabel">1</xsl:param>
  <xsl:param name="chunker.output.indent">yes</xsl:param>
  <xsl:param name="chunker.output.encoding">UTF-8</xsl:param>
  <xsl:param name="chunk.first.sections">0</xsl:param>
  <xsl:param name="chunk.tocs.and.lots">0</xsl:param>
  <xsl:param name="html.stylesheet">style.css</xsl:param>

</xsl:stylesheet>
