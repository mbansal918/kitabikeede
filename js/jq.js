$(function () {
	var images = [], 
	notification1 = document.createElement('div'), 
	notification2 = document.createElement('div'),
	notification3 = document.createElement('div'), 
	container = document.getElementById('notifications');


	images.push(new Image());
	images.push(new Image());
	images.push(new Image());
	images[0].src = "http://cssdeck.com/uploads/media/items/6/6zO6dK2.png";
	images[1].src = "http://cssdeck.com/uploads/media/items/7/7jvL4q5.png";
	images[2].src = "http://cssdeck.com/uploads/media/items/2/2nifRaa.png";
	notification1.setAttribute('class', 'notification');
	notification2.setAttribute('class', 'notification');
	notification3.setAttribute('class', 'notification');
	notification1.innerHTML = '<img src='+ images[0].src + '> <p>This is the HUD notification style. The only image used is for the icon.</p>';
	notification2.innerHTML = '<img src='+ images[1].src + '> <p>Everything other than the icon is CSS3. Javascript is used to add notifications to the page after a delay, but nothing else.</p>';
	notification3.innerHTML = '<img src='+'> <p>The text can be as long as it needs to be and the notification will stretch to contain it: Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>';
	
	setTimeout(function() {
	  container.appendChild(notification1);
	}, 1000);
	setTimeout(function() {
	  container.appendChild(notification2);
	}, 3000);
	setTimeout(function() {
	  container.appendChild(notification3);
	}, 5000);
});