#---
# Excerpted from "Mastering Dojo",
# published by The Pragmatic Bookshelf.
# Copyrights apply to this code. It may not be used to create training material, 
# courses, books, articles, and the like. Contact us if you are in doubt.
# We make no guarantees that this code is fit for any purpose. 
# Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
#---
require 'webrick'
require 'uri'

include WEBrick

server= HTTPServer.new(:Port=>8002, :DocumentRoot=>"C:/dev/dojo-book/code/baf/step2")
server.mount("/dojoroot", HTTPServlet::FileHandler, "C:/dev/dojo/dojo-release-1.1.0-src")
server.mount("/dojoroot/baf", HTTPServlet::FileHandler, "C:/dev/dojo-book/code/baf/step2/baf")
server.mount("/dojoroot/obe", HTTPServlet::FileHandler, "C:/dev/dojo-book/code/baf/step2/obe")

['TERM', 'INT'].each do |signal|
  trap(signal){server.shutdown}
end

server.start
