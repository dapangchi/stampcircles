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

class MasteringDojoRemoteScripting < HTTPServlet::AbstractServlet
  def do_GET(request, response)
    id= request.request_uri.path.match('[^/]+$')[0]
    self.send(id, request, response, "myTest")
    response.status= 200
    return
  rescue
    response.status= 400
  end

  def do_POST(request, response)
    id= request.request_uri.path.match('[^/]+$')[0]
    self.send(id, request, response, "myTest")
    response.status= 200
    return
  rescue
    response.status= 400
  end
  
  def id1(request, response, test)
    response.body= "hello, world"
    response['Content-Type']= 'text/plain'
  end  
    
  def id2(request, response, test)
    response.body= '{"firstName": "George", "lastName": "Bush", "address": {"street": "1600 Pennsylvania Avenue NW", "city": "Washington", "state": "DC", "zip": "20500"}}';
    response['Content-Type']= 'text/plain'
  end    
    
  def id3(request, response, test)
    response.body= '/*{"firstName": "George", "lastName": "Bush", "address": {"street": "1600 Pennsylvania Avenue NW", "city": "Washington", "state": "DC", "zip": "20500"}}*/';
    response['Content-Type']= 'text/plain'
  end 
      
  def id4(request, response, test)
    response.body= 'Number(dojo.byId("exId").value) * 10'
    response['Content-Type']= 'text/plain'
  end 
      
  def id5(request, response, test)
    response.body= '<contact><firstName>George</firstName><lastName>Bush</lastName><address street="1600 Pennsylvania Avenue NW" city="Washington" state="DC" zip="20500" /></contact>'
    response['Content-Type']= 'text/xml'
  end   
      
  def id6(request, response, test)
    response.body= '/*{"firstName": "George", "lastName": "Bush", "address": {"street": "1600 Pennsylvania Avenue NW", "city": "Washington", "state": "DC", "zip": "20500"}}*/';
    response['Content-Type']= 'text/plain'
  end 
      
  def id7(request, response, test)
    params= []
    request.query.each{|k, v|
      params.push('"' + k.to_s + '": "' + v.to_s + '"')
    }
    response.body= "{result:{" + params.join(",") + "}}"
    # response.body= '{"result": "' + request.body + '"}'
    response.body= '{"result": "7"}'
    response['Content-Type']= 'text/plain'
  end
  
  def id8(request, response, test)
    response.body= %q{
      id8Object= {};
      id8Object.result= "exercise15--hello, world";
    }
    response['Content-Type']= 'text/javascript'
  end 
  
  def id9(request, response, test)
    response.body= %Q{
      #{request.query["callbackName"]}({"result": "exercise16--hello, world"});
    }
    response['Content-Type']= 'text/javascript'
  end
  
  def id10(request, response, test)
    sleep(5)
    STDOUT << request.body
    response.body= %Q{<div id="result"><p>hello, world from iframe</p></div>'}
    
    response['Content-Type']= 'text/html'
  end
  
  def id11(request, response, test)
    STDOUT << request.body
    response.body= %Q{
      <html>
        <body>
            <textarea>{result: "OK"}</textarea>
        </body>
      </html>
    }
    response['Content-Type']= 'text/html'
  end
  
  def id12(request, response, test)
    if (request.query["escape"])
      response.body= %Q{
        <html>
          <head>
            <script type="text/javascript">
              function rawldLoad(){
                value = window["document"].getElementsByTagName("textarea")[0].value; //text
                this.parent.rawld= value;
                debugger;
                alert(value);
              }
            </script>
          </head>
          <body onLoad="rawldLoad();">
              <textarea>{"left-angle-bracket": "&amp;lt;", "amperstand": "&amp;amp;", "close": "&lt;/textarea>"}</textarea>
          </body>
        </html>
      }
    else
      response.body= %Q{
        <html>
          <head>
          </head>
          <body>
              <textarea>{"left-angle-bracket": "<", "amperstand": "&", "close": "</textarea>"}</textarea>
          </body>
        </html>
      }
    end
    response['Content-Type']= 'text/html'
  end
  
  def ex50(request, response, test)
    response.body= %Q{<p>response: #{request.query["clickId"]}</p><p>hello, world</p>}
    response['Content-Type']= 'text/plain'
  end
  
  def ex3(request, response, test)
    sleep(5)
    response.body= "pause 3s, then...hello, world"
    response['Content-Type']= 'text/plain'
  end
end

server= HTTPServer.new(:Port=>8002, :DocumentRoot=>'c:/dev/dojo-book/code')
server.mount('/remote-scripting/demo', MasteringDojoRemoteScripting)
server.mount("/dojoroot", HTTPServlet::FileHandler, "C:/dev/dojo/dojo-release-1.1.0-src")

['TERM', 'INT'].each do |signal|
  trap(signal){server.shutdown}
end

server.start
