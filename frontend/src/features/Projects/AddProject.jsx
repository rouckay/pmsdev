import Button from "../../components/Button";
import CreateProjectForm from "./CreateProjectForm";
import Modal from "../../components/Modal";

const AddProject = () => {
  return (
    <Modal>
      <Modal.Open opens="project-form">
        <Button>Add Project</Button>
      </Modal.Open>
      <Modal.Window name="project-form">
        <CreateProjectForm />
      </Modal.Window>
    </Modal>
  );
};

// const AddProject = () => {
//   const [showProjectForm, setShowProjectForm] = useState(false);

//   const handleCloseProjectForm = () => {
//     setShowProjectForm(false);
//   };

//   return (
//     <div className="flex flex-col">
//       <div className="pr-2 self-end">
//         <Button
//           onClick={() => setShowProjectForm((show) => !show)}
//           className="bg-blue-500 text-white py-2 px-4 rounded-md"
//         >
//           Add Project
//         </Button>
//       </div>
//       <div>
//         {showProjectForm && (
//           <CreateProjectForm onClose={handleCloseProjectForm} />
//         )}
//       </div>
//     </div>
//   );
// };

export default AddProject;
