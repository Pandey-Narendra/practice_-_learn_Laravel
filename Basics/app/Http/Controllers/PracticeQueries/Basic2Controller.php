<?php

namespace App\Http\Controllers\PracticeQueries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Role;
use App\Models\Post;
use App\Models\User;

use function Laravel\Prompts\select;

class Basics2Controller extends Controller
{
    // 01) Write a query to fetch the second highest salary from an Employee table.
    public function query_01() {
        $sqlDBRaw = DB::raw('
                select distinct(max(salary))
                from employees 
                where salary < (
                        select max(salary) 
                        from employees
                    )
            ')
        ; 

        // SELECT DISTINCT salary FROM Employees ORDER BY salary DESC LIMIT 1 OFFSET 1;

    }

    public function query_02() {
        // 02) Write a query to fetch the nth highest salary from an Employee table.
            
                //  SELECT DISTINCT salary FROM Employees ORDER BY salary DESC LIMIT 1 OFFSET (n-1);

                // select salary
                // from (
                //     select distinct salary, 
                //         Dense_Rank() OVER (order by salary DESC) as rnk
                //     from employees
                // ) as ranked
                // where rnk = 6;

        // 3) Find employees who earn more than the average salary.

                // SELECT employee_id, first_name, last_name, salary
                // FROM Employees
                // WHERE salary > (SELECT AVG(salary) FROM Employees);


        // 4) Find the duplicate records in a table.

                // SELECT name, email, salary, COUNT(*) 
                // FROM Employees 
                // GROUP BY name, email, salary 
                // HAVING COUNT(*) > 1;

        // 5) Delete duplicate records from a table.
                // delete e1 
                // from employees e1
                // join employees e2 
                // where e1.first_name = e2.first_name and e1.last_name =e2.last_name and e1.employee_id > e2.employee_id;

        // 6) Find employees who do not have a manager.
                // SELECT employee_id, first_name, last_name 
                // FROM Employees 
                // WHERE manager_id IS NULL;

        // 7) Write a query to find employees who have the same salary.
                // select e1.first_name, e1.last_name, e1.salary, e2.first_name, e2.last_name, e2.salary
                //  from employees e1 
                // join employees e2 on e1.salary = e2.salary and e1.employee_id < e2.employee_id;

        // 8. Write a query to display employees whose names start with ‘A’.
                // SELECT employee_id, first_name, last_name 
                // FROM Employees 
                // WHERE first_name LIKE 'A%';
            
        // 9) Write a query to find employees hired in the last 30 days. 
                //  select * from employees where hire_date >= Date_Sub(CURDATE(), INTERVAL 30 day);

        // 10. Write a query to get the current date and time in SQL.
                // SELECT NOW();  -- MySQL/PostgreSQL (timestamp)
                // -- OR SELECT CURRENT_DATE; for date only
            
        // 11) Find employees and their managers in one query. 
                //  SELECT e1.first_name, e2.last_name, concat(e2.first_name, " ", e2.last_name) as manager_name 
                // from employees e1 
                // left join employees e2 on e1.manager_id = e2.employee_id;

        // 12)  Find all employees who belong to a department with more than 10 employees.

        // 13)   Write a query to list departments that have no employees. 
                    // select * 
                    // from departments 
                    // where department_id not in ( SELECT DISTINCT(department_id) from employees );

                    // or

                    // SELECT d.department_id, d.department_name
                    // FROM Departments d
                    // LEFT JOIN Employees e ON d.department_id = e.department_id
                    // WHERE e.employee_id IS NULL;

        // 14) Write a query to join employees with departments and show department names.

                // SELECT e.employee_id, e.first_name, d.department_name
                // FROM Employees e
                // INNER JOIN Departments d ON e.department_id = d.department_id;

        // 15) Write a query to join multiple tables (employee, department, salary).

            // -- Assume CREATE TABLE Salaries (employee_id INT, salary DECIMAL(10,2));
            // SELECT e.employee_id, e.first_name, d.department_name, s.salary
            // FROM Employees e
            // INNER JOIN Departments d ON e.department_id = d.department_id
            // INNER JOIN Salaries s ON e.employee_id = s.employee_id;

        // 16) Write a query using a subquery to find employees with salary > average salary.
                //  select * from employees where salary > (select avg(salary) from employees)

        // 17) Write a query using a correlated subquery to find the highest salary in each department. 
                // SELECT d.department_name, 
                //     (SELECT MAX(e2.salary) FROM Employees e2 WHERE e2.department_id = d.department_id) AS max_salary
                // FROM Departments d;

        // 18) Write a query using NOT EXISTS to find departments without employees.
                // SELECT d.department_id, d.department_name
                // FROM Departments d
                // WHERE NOT EXISTS (SELECT 1 FROM Employees e WHERE e.department_id = d.department_id);

        // 19) Write a query using ANY
                // SELECT * FROM Employees WHERE salary > ANY (SELECT salary FROM Employees WHERE department_id = 1);  -- > any in subquery

        // 20) Write a query using ALL
                // SELECT * FROM Employees WHERE salary > ALL (SELECT salary FROM Employees WHERE department_id = 1);  -- > ALL in subquery

        // 21) Find total salary department-wise
                // SELECT d.department_name, SUM(e.salary) AS total_salary
                // // FROM Employees e
                // // INNER JOIN Departments d ON e.department_id = d.department_id
                // // GROUP BY d.department_name;

        // 22)  Find average salary department-wise.
                // SELECT d.department_name, AVG(e.salary) AS avg_salary
                // FROM Employees e
                // INNER JOIN Departments d ON e.department_id = d.department_id
                // GROUP BY d.department_name;

        // 23)  Find maximum salary department-wise.
                // SELECT d.department_name, MAX(e.salary) AS max_salary
                // FROM Employees e
                // INNER JOIN Departments d ON e.department_id = d.department_id
                // GROUP BY d.department_name;

        // 24) Count employees in each department. 
                // SELECT d.department_name, COUNT(e.employee_id) AS employee_count
                // FROM Departments d
                // LEFT JOIN Employees e ON d.department_id = e.department_id
                // GROUP BY d.department_name;

        // 25) Find department with the highest average salary.
    }


}
