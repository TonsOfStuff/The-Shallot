const articleDiv = document.querySelector(".articleContent");
let articleText = articleDiv.innerHTML;

//Links
articleText = articleText.replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$1">$2</a>');

//Bolding
articleText = articleText.replace(/\*\*([^\*]+)\*\*/g, '<strong>$1</strong>');

//Center
articleText = articleText.replace(/\[center\](.+?)(\r?\n|$)/g, '<div class="center">$1</div>');

//Plain div for paragraphs
articleText = articleText.replace(/(.+?)(\r?\n|$)/g, '<div class = "paragraph">$1</div>');


articleDiv.innerHTML = articleText;