import React, { useState } from 'react';
import { v4 as uuidv4 } from 'uuid';
import './App.css';

const App = () => {
  const [items, setItems] = useState([]);
  const [currentItem, setCurrentItem] = useState({ id: null, name: '', surname: '', emai: '' });

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setCurrentItem({ ...currentItem, [name]: value });
  };

  const addItem = () => {
    if (currentItem.name && currentItem.surname && currentItem.email) {
      setItems([...items, { id: uuidv4(), name: currentItem.name, surname: currentItem.surname, email: currentItem.email}]);
      setCurrentItem({ id: null, name: '', surname: '', email:'' });
    }
  };

  const deleteItem = (id) => {
    setItems(items.filter((item) => item.id !== id));
  };

  const editItem = (item) => {
    setCurrentItem(item);
  };

  const updateItem = () => {
    setItems(items.map((item) => (item.id === currentItem.id ? currentItem : item)));
    setCurrentItem({ id: null, name: '', surname: '', email: '' });
  };

  return (
    <div className="App">
      <h1>CRUD</h1>
      <form className="form">
      <input
        type="text"
        name="name"
        value={currentItem.name}
        onChange={handleInputChange}
        placeholder='First Name'
      />
      <input
        type="text"
        name="surname"
        value={currentItem.surname}
        onChange={handleInputChange}
        placeholder='Surname'
      />
      <input
          type="email"
          name="email"
          value={currentItem.email}
          onChange={handleInputChange}
          placeholder="Email"
        />
      <button type="button" onClick={currentItem.id ? updateItem : addItem}>
        {currentItem.id ? 'Update' : 'Add'}
      </button>
      </form>
      <ul>
        {items.map((item) => (
          <li key={item.id}>
            {item.name} {item.surname} {item.email}
            <button onClick={() => editItem(item)}>Edit</button>
            <button onClick={() => deleteItem(item.id)}>Delete</button>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default App;
