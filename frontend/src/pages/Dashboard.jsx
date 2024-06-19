import Button from "../components/Button";

const dashboard = () => {
  return (
    <div className="flex flex-col gap-2">
      <div className="pr-4 self-end">
        <Button>Add Project</Button>
      </div>
      <div>Projects</div>
    </div>
  );
};

export default dashboard;
