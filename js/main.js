window.addEventListener('load', function () {

    document.querySelector('.scroll-top').addEventListener('click', function() {		
        window.scrollTo({ top: 0, behavior: 'smooth' });	
    })
		
    window.addEventListener('scroll', function(){
        if ( this.scrollY > 1000) {
            document.querySelector('.scroll-top').style.opacity = '1';
        } else {
            document.querySelector('.scroll-top').style.opacity = '0';
        }
    })

    function toggleMenu(){
        document.querySelector('.menu_mobile').classList.toggle('show');
        document.querySelector('.header .overlay').classList.toggle('active');
    }

    let burgerBtn = document.querySelector('.burger img');
    let closeBtn = document.querySelector('.menu_mobile .close');
	let overlayBack = document.querySelector('.overlay');
                
	if (burgerBtn) {
		burgerBtn.addEventListener('click', toggleMenu);	
	}
	if (closeBtn) {
		closeBtn.addEventListener('click', toggleMenu);	
	}

	if (overlayBack) {
		overlayBack.addEventListener('click', function() {
			document.querySelector('.menu_mobile').classList.remove('show');
			this.classList.remove('active');
		})
	}	

    let questions = document.querySelectorAll('.faq__item');
    for(question of questions){

        question.addEventListener('click', function(){
            this.classList.toggle('open');
            this.querySelector('.faq__answer').classList.toggle('active');
        })
    }
	
	let fixBlock = document.querySelector('.fixed__block');
    if (fixBlock) {
        window.addEventListener('scroll', function() {
            if ( this.scrollY > 1000 && fixBlock) {
                fixBlock.style.opacity = '1';
            } else {
                fixBlock.style.opacity = '0';
            }
        })
    }
    
})








