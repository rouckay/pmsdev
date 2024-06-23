import { useState } from "react";
import Button from "../components/Button";
import CreateProjectForm from "../features/Projects/CreateProjectForm";

import ProjectsTable from "../features/Projects/ProjectsTable";

const Dashboard = () => {
  const [showProjectForm, setShowProjectForm] = useState(false);

  const handleCloseProjectForm = () => {
    setShowProjectForm(false);
  };

  return (
    <div className="flex flex-col gap-4">
      <div className="pr-2 self-end">
        <Button
          onClick={() => setShowProjectForm((show) => !show)}
          className="bg-blue-500 text-white py-2 px-4 rounded-md"
        >
          Add Project
        </Button>
      </div>
      <div>
        {showProjectForm && (
          <CreateProjectForm onClose={handleCloseProjectForm} />
        )}
      </div>
      <ProjectsTable />
    </div>
  );
};

export default Dashboard;
