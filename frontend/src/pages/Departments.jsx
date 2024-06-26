import DepartmentsTable from "../features/Departments/DepartmentsTable";
import AddDepartment from "../features/Departments/AddDepartment";

const Departments = () => {
  return (
    <div className="flex flex-col gap-4">
      <AddDepartment />
      <DepartmentsTable />
    </div>
  );
};

export default Departments;
