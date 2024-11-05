import './App.css'; 
import Header from './Camponents/Header';
import Todos from './Camponents/Todos';
import Footer from './Camponents/Footer';
import AddTodo from './Camponents/AddTodo';
import About from './Camponents/About';
import React, { useState, useEffect } from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom'; // Import Routes instead of Switch

function App() {
  // Initialize todos from local storage or set as an empty array
  let initTodo;
  if (localStorage.getItem("todos") === null) {
    initTodo = [];
  } else {
    initTodo = JSON.parse(localStorage.getItem("todos")); // Corrected to get items, not set
  }

  // Set up state for todos
  let [todos, setTodos] = useState(initTodo); // Use initTodo directly

  // Update local storage whenever todos change
  useEffect(() => {
    localStorage.setItem("todos", JSON.stringify(todos));
  }, [todos]);

  // Delete todo function
  let onDelete = (todo) => {
    console.log("onDelete", todo);
    setTodos(todos.filter((e) => e !== todo));
  };

  // Add todo function
  let addTodo = (title, desc) => {
    console.log("Adding", title, desc);
    const myTodo = {
      id: Math.floor(Math.random() * 100000),
      title: title,
      desc: desc
    };
    console.log(myTodo);
    setTodos([...todos, myTodo]);
  };

  return (
    <>
      <Router>
        <Header title="Todo's List" />
        <Routes> {/* Use Routes instead of Switch */}
          <Route exact path='/' element={
            <>
              <AddTodo addTodo={addTodo} />
              {/* Display an alert if there are no todos */}
              {todos.length === 0 ? (
                <div className="container">
                  <div className="alert alert-warning" role="alert">
                    No Todo's Found
                  </div>
                </div>
              ) : (
                <Todos todos={todos} onDelete={onDelete} />
              )}
            </>
          } />
          <Route exact path='/about' element={<About />} />
        </Routes>
        <Footer />
      </Router>
    </>
  );
}

export default App;
