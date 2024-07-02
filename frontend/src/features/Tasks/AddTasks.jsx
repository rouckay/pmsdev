import Modal from "../../components/Modal";
import Button from "../../components/Button";
import CreateTasksForm from "./CreateTasksForm";

const AddTasks = () => {
  return (
    <Modal>
      <Modal.Open opens="tasks-form">
        <div className="flex self-end">
          <Button>Add Task</Button>
        </div>
      </Modal.Open>
      <Modal.Window name="tasks-form">
        <CreateTasksForm />
      </Modal.Window>
    </Modal>
  );
};

export default AddTasks;
