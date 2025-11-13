let canvas = document.getElementById("bubble");
let ctx = canvas.getContext("2d");

let window_width = window.innerWidth;
let window_height = window.innerHeight;

canvas.width = window_width;
canvas.height = window_height;

class circle{
    constructor(xpos, ypos, radius, color, speed){
        this.xpos = xpos;
        this.ypos = ypos;
        this.radius = radius;
        this.color = color;
        this.speed = speed;

        this.dx = 1 * this.speed;
        this.dy = 1 * this.speed;
    }

    draw(ctx){
        ctx.beginPath();
        ctx.fillStyle = this.color;
        ctx.arc(this.xpos, this.ypos, this.radius, 0, Math.PI * 2, false);
        ctx.fill();
        ctx.closePath();
    }

    update(){
        this.draw(ctx);

        if((this.xpos + this.radius) > window_width){
            this.dx = -this.dx;
        }

        if((this.xpos + this.radius) < 0){
            this.dx = -this.dx;
        }  

        if((this.ypos + this.radius) > window_height){
            this.dy = -this.dy;
        }

        if((this.ypos + this.radius) < 0){
            this.dy = -this.dy;
        }        

        this.xpos += this.dx;
        this.ypos += this.dy;        
    }
}

let getDistance = function(xpos1, ypos1, xpos2, ypos2){
    let result = Math.sqrt(Math.pow(xpos2 - xpos1, 2) + Math.pow(ypos2 - ypos1, 2));
    return result;
}

let all_circles = [];

let random_number = function(min, max){
    let result = Math.random() * (max - min) + min;
    return result;
}

let draw_circle = function(circles){
    circles.draw(ctx);
}


for(let num=0; num<2; num++){
    // random size
    let my_radius = '';
    let my_color = '';
    let my_x = '';
    let my_y = '';

    if(!num){
        my_radius = 400;
        my_color = '#ff0088';
        my_x = 800;
        my_y = 300;
    }else{
        my_radius = 200;
        my_color = '#1eec8b';
        my_x = 150;
        my_y = 150;
    }

    let my_circle = new circle(my_x, my_y, my_radius, my_color, 5);
    all_circles.push(my_circle);
}

let update_circle = function(){
    requestAnimationFrame(update_circle);
    ctx.clearRect(0,0, window_width, window_height);

    all_circles.forEach(element => {
        element.update();
    })
}

update_circle();