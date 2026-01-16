import { useState } from 'react'
import { useNavigate } from 'react-router-dom'
import api from '../api/axios'

function AdminCreateProduct() {
    const navigate = useNavigate()

    const [name, setName] = useState('')
    const [type, setType] = useState('card')

    const [newPrice, setNewPrice] = useState('')
    const [newStock, setNewStock] = useState('')

    const [usedPrice, setUsedPrice] = useState('')
    const [usedStock, setUsedStock] = useState('')

    const [message, setMessage] = useState('')
    const [error, setError] = useState('')

    /**
     * Create product and its prices (new & used)
     */
    const handleSubmit = async (e) => {
        e.preventDefault()
        setError('')
        setMessage('')

        try {
            // 1️⃣ Create product
            const productRes = await api.post('/products', {
                name,
                type,
            })

            const productId = productRes.data.id

            // 2️⃣ Create NEW product value
            await api.post('/product-values', {
                product_id: productId,
                condition: 'new',
                price: newPrice,
                stock: newStock,
            })

            // 3️⃣ Create USED product value
            await api.post('/product-values', {
                product_id: productId,
                condition: 'used',
                price: usedPrice,
                stock: usedStock,
            })

            setMessage('Product created successfully')
            setTimeout(() => navigate('/products'), 1000)

        } catch (err) {
            console.error(err)
            setError('Error creating product')
        }
    }

    return (
        <div className="page-container">
            <h2>Create new product (Admin)</h2>

            {message && <p className="success">{message}</p>}
            {error && <p className="error">{error}</p>}

            <form onSubmit={handleSubmit} className="auth-form">

                <input
                    type="text"
                    placeholder="Product name"
                    value={name}
                    onChange={e => setName(e.target.value)}
                    required
                />

                <select value={type} onChange={e => setType(e.target.value)}>
                    <option value="card">Card</option>
                    <option value="pack">Pack</option>
                    <option value="box">Box</option>
                </select>

                <h4>New condition</h4>
                <input
                    type="number"
                    placeholder="Price (€)"
                    value={newPrice}
                    onChange={e => setNewPrice(e.target.value)}
                    required
                />
                <input
                    type="number"
                    placeholder="Stock"
                    value={newStock}
                    onChange={e => setNewStock(e.target.value)}
                    required
                />

                <h4>Used condition</h4>
                <input
                    type="number"
                    placeholder="Price (€)"
                    value={usedPrice}
                    onChange={e => setUsedPrice(e.target.value)}
                    required
                />
                <input
                    type="number"
                    placeholder="Stock"
                    value={usedStock}
                    onChange={e => setUsedStock(e.target.value)}
                    required
                />

                <button type="submit">Create product</button>
            </form>
        </div>
    )
}

export default AdminCreateProduct


