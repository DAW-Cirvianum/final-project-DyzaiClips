import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom'
import { useState, useEffect } from 'react'

import Home from './pages/Home'
import Login from './auth/Login'
import Register from './auth/Register'
import ProtectedRoute from './auth/ProtectedRoute'

import Products from './pages/Products'
import ProductValues from './pages/ProductValues'
import Navbar from './components/Navbar'
import MyTransactions from './pages/MyTransactions'

import EditProduct from './pages/EditProduct'

import AdminCreateProduct from './pages/AdminCreateProduct'



function App() {
  const [token, setToken] = useState(null)

  // Load token on app start
  useEffect(() => {
    const storedToken = localStorage.getItem('token')
    setToken(storedToken)
  }, [])

  return (
    <BrowserRouter>

      {/* Navbar only when authenticated */}
      {token && <Navbar setToken={setToken} />}

      <Routes>

        {/* Public pages */}
        <Route path="/" element={<Home />} />
        <Route path="/login" element={<Login setToken={setToken} />} />
        <Route path="/register" element={<Register />} />

        {/* Protected pages */}
        <Route
          path="/products"
          element={
            <ProtectedRoute token={token}>
              <Products />
            </ProtectedRoute>
          }
        />

        <Route
          path="/product-values"
          element={
            <ProtectedRoute token={token}>
              <ProductValues />
            </ProtectedRoute>
          }
        />

        <Route
          path="/products/:id/prices"
          element={
            <ProtectedRoute>
              <ProductValues />
            </ProtectedRoute>
          }
        />

        <Route
          path="/products/:id/edit"
          element={
            <ProtectedRoute adminOnly>
              <EditProduct />
            </ProtectedRoute>
          }
        />
        <Route
          path="/my-transactions"
          element={
            <ProtectedRoute>
              <MyTransactions />
            </ProtectedRoute>
          }
        />

        <Route
          path="/admin/products/create"
          element={
            <ProtectedRoute adminOnly>
              <AdminCreateProduct />
            </ProtectedRoute>
          }
        />





        {/* Fallback */}
        <Route path="*" element={<Navigate to="/" />} />

      </Routes>
    </BrowserRouter>
  )
}

export default App


