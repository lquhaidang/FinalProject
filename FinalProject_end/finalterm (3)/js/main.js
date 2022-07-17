let addBtn = document.querySelector(".add-btn");
let deleteBtn = document.querySelector(".delete-btn");
let questionSpace = document.querySelector(".create-question-space");
let test = document.querySelector(".test");
let count = 2;
let arr = [];
arr.push(questionSpace.children[0]);
let n = 0;
addBtn.addEventListener("click", (event) => {
    let output = `
        <div class="card-body">
            <div class="form-group">
                <label for="text_question${count}">Question Text</label>
                <input type="text" name="text_question${count}" class="form-control" placeholder="Add question text...">
            </div>

            <div class="row">
                <div class="col">
                    <label for="text_answer1">Answer 1 Text</label>
                    <input type="text" name="text_answer1_${count}" class="form-control" placeholder="Add answer 1 text...">
                </div>
                <div class="col">
                    <label for="text_answer2">Answer 2 Text</label>
                    <input type="text" name="text_answer2_${count}" class="form-control" placeholder="Add answer 2 text...">
                </div>
            </div>

            <div class="row mt-2">
                <div class="col">
                    <label for="text_answer3">Answer 3 Text</label>
                    <input type="text" name="text_answer3_${count}" class="form-control" placeholder="Add answer 3 text...">
                </div>
                <div class="col">
                    <label for="text_answer4">Answer 4 Text</label>
                    <input type="text" name="text_answer4_${count}" class="form-control" placeholder="Add answer 4 text...">
                </div>
            </div>

            <div class="row">
                <legend class="col-form-label col-sm-10 pt-0 mt-2">Correct Answer:</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="Ans${count}" id="Anskey1" value="1" checked>
                        <label class="form-check-label" for="Anskey1">
                            Answer 1
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="Ans${count}" id="Anskey2" value="2">
                        <label class="form-check-label" for="Anskey2">
                            Answer 2
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="Ans${count}" id="Anskey3" value="3">
                        <label class="form-check-label" for="Anskey3">
                            Answer 3
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="Ans${count}" id="Anskey4" value="4">
                        <label class="form-check-label" for="Anskey4">
                            Answer 4
                        </label>
                    </div>
                </div>
            </div>
        </div>`;
    questionSpace.insertAdjacentHTML("beforeend", output);

    let n = questionSpace.children.length - 1;
    arr.push(questionSpace.children[n]);
    console.log(arr);
    count++;
});

deleteBtn.addEventListener("click", (event) => { 
    arr.pop();
    count--;
    console.log(arr);
    questionSpace.innerHTML = "";
    arr.forEach(element => {
        questionSpace.appendChild(element);
    });
});