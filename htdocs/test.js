const http = require("http");

const server = http();

const users = [
    {
        id:'aphlox',
        name: "june",
        email:'aphlox@naver.com'
    },
    {
        id:"veronica9",
        name:'haru',
        email:"haru@gmail.com"
    }
];

server.get("/api/user",(req,res)=> {
    res.json(users);

});

http.createServer(function(req, res) {
    res.writeHead(200, { " Content-Type": "text/plain"});
    res.write("Hello\r\n");
    res.write("World\r\n");
    res.end();

}).listen(80);