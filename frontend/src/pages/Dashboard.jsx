import { useState } from "react";
import Button from "../components/Button";
import CreateProjectForm from "../features/Projects/CreateProjectForm";

import ProjectsTable from "../features/Projects/ProjectsTable";

const Dashboard = () => {
  const [showForm, setShowForm] = useState(false);

  const [isModalOpen, setIsModalOpen] = useState(false);

  const handleOpenModal = () => setIsModalOpen(true);
  const handleCloseModal = () => setIsModalOpen(false);
  return (
    <div className="flex flex-col gap-4">
      <div className="pr-2 self-end">
        <Button onClick={() => setShowForm((show) => !show)}>
          Add Project
        </Button>
      </div>
      <div>{showForm && <CreateProjectForm />}</div>
      <ProjectsTable />
    </div>
  );
};

export default Dashboard;
