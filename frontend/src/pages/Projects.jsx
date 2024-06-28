import AddProject from "../features/Projects/AddProject";
import ProjectsTable from "../features/Projects/ProjectsTable";

const Projects = () => {
  return (
    <div className="flex flex-col gap-4">
      <AddProject />
      <ProjectsTable />
    </div>
  );
};

export default Projects;
