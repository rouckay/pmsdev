import Button from "../../components/Button";
import Modal from "../../components/Modal";
import CreateDepartmentForm from "./CreateDepartmentForm";

const AddDepartment = () => {
  return (
    <Modal>
      <Modal.Open opens="department-form">
        <Button onClick={close}>Add Department</Button>
      </Modal.Open>
      <Modal.Window name="department-form">
        <CreateDepartmentForm />
      </Modal.Window>
    </Modal>
  );
};

export default AddDepartment;
