import { useState } from "react";
import CreateDepartmentForm from "../features/Departments/CreateDepartmentForm";
import Button from "../components/Button";
import DepartmentsTable from "../features/Departments/DepartmentsTable";

const Departments = () => {
  const [showDepartmentForm, setShowDepartmentForm] = useState(false);

  const handleClose = () => {
    setShowDepartmentForm(false);
  };

  return (
    <div className="flex flex-col gap-4">
      <div className="pr-2 self-end">
        <Button onClick={() => setShowDepartmentForm((show) => !show)}>
          Add Department
        </Button>
      </div>
      <div>
        {showDepartmentForm && <CreateDepartmentForm onClose={handleClose} />}
      </div>
      <DepartmentsTable />
    </div>
  );
};

export default Departments;
