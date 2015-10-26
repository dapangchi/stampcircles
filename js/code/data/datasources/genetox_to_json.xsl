<?xml version="1.0" encoding="UTF-8"?>
<!--
 ! Excerpted from "Mastering Dojo",
 ! published by The Pragmatic Bookshelf.
 ! Copyrights apply to this code. It may not be used to create training material, 
 ! courses, books, articles, and the like. Contact us if you are in doubt.
 ! We make no guarantees that this code is fit for any purpose. 
 ! Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
-->
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
                version="1.0">
    <xsl:output method="text"/>
    <xsl:template match="/">
{ identifier: "docno",
  label: "substance",
  items: [
      <xsl:apply-templates 
        select="/genetox/DOC"/>
      { endOfFile: true }
  ]
}
    </xsl:template>
    
    <xsl:template match="/genetox/DOC">
    { docno:"<xsl:value-of select="DOCNO"/>", 
      substance:"<xsl:value-of select="NameOfSubstance"/>", 
      taxonomy:"<xsl:value-of select="tax"/>", 
      date:"<xsl:value-of select="date"/>",
      specimen:"<xsl:value-of select="normalize-space(gena/spcta)"/>", 
      result:"<xsl:value-of select="gena/resa"/>"
    },
    </xsl:template>
    
</xsl:stylesheet>