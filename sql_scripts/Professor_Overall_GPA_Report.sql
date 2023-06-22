Select sum(T.GPA)/sum(T.quantity) as 'Course GPA' from
(Select grade, quantity, 
        CASE 
		WHEN grade='A' THEN 4 
        WHEN grade="B" THEN 3 
        WHEN grade="C" THEN 2
        WHEN grade="D" THEN 1
        WHEN grade="F" THEN 0
        else 0
        END * quantity as 'GPA'
from courses_x_professors_with_grades
join professors on professor_ID=professors.id
where lastName="Hall" and firstName="Rhonda Michele" and grade in ("A","B","C","D","F","W") )as `T`;