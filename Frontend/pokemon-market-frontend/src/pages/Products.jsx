import { useEffect, useState } from 'react'
import { useNavigate } from 'react-router-dom'
import api from '../api/axios'

function Products() {
    const [products, setProducts] = useState([])
    const [search, setSearch] = useState('')
    const isAdmin = localStorage.getItem('role') === 'admin'
    const navigate = useNavigate()


    {
        isAdmin && (
            <button
                className="admin-btn"
                onClick={() => navigate('/admin/products/create')}
            >
                + Create Product
            </button>
        )
    }

    useEffect(() => {
        api.get('/products')
            .then(res => setProducts(res.data))
    }, [])

    /**
     * Delete a product (admin only)
     *
     * @param {number} id
     */
    const handleDelete = async (id) => {
        if (!window.confirm('Are you sure you want to delete this product?')) {
            return
        }

        await api.delete(`/products/${id}`)
        setProducts(products.filter(product => product.id !== id))
    }

    /**
     * Filter products by name (search input)
     */
    const filteredProducts = products.filter(product =>
        product.name.toLowerCase().includes(search.toLowerCase())
    )

    return (
        <div className="page-container">
            <h2>Products</h2>
            {isAdmin && (
                <button
                    className="admin-btn"
                    onClick={() => navigate('/admin/products/create')}
                >
                    + Add new product
                </button>
            )}

            {/* Search input */}
            <input
                type="text"
                className="search-input"
                placeholder="Search product by name..."
                value={search}
                onChange={e => setSearch(e.target.value)}
            />

            <div className="product-grid">
                {filteredProducts.map(product => (
                    <div key={product.id} className="product-card">
                        <h3>{product.name}</h3>

                        <span className="product-type">
                            {product.type}
                        </span>

                        <button
                            className="product-btn"
                            onClick={() => navigate(`/products/${product.id}/prices`)}
                        >
                            View prices
                        </button>

                        {isAdmin && (
                            <div className="admin-actions">
                                <button
                                    className="product-btn edit"
                                    onClick={() => navigate(`/products/${product.id}/edit`)}
                                >
                                    Edit
                                </button>

                                <button
                                    className="product-btn delete"
                                    onClick={() => handleDelete(product.id)}
                                >
                                    Delete
                                </button>
                            </div>
                        )}
                    </div>
                ))}
            </div>
        </div>
    )
}

export default Products


