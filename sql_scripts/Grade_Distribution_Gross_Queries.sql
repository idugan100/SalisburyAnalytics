Select grade, sum(quantity)
from courses_x_professors_with_grades
join courses on courses.id=course_ID
where courseID=4
group by grade;

Select grade, sum(quantity)
from courses_x_professors_with_grades
join professors on professors.id=professor_ID
where professor_ID=4
group by grade;