import React from 'react';
import {PageHeader, Button, Descriptions, Layout, Breadcrumb} from 'antd';
import {HomeOutlined} from '@ant-design/icons';
import {Link} from "react-router-dom";

const {Content} = Layout;

function Docs() {
    return (
        <div>
            <Breadcrumb style={{margin: '16px 0'}}>
                <Breadcrumb.Item>
                    <Link to="/">
                        <HomeOutlined/> Home
                    </Link>
                </Breadcrumb.Item>
            </Breadcrumb>
            <Content className="site-layout-background" style={{}}>
                <PageHeader
                    ghost={false}
                    onBack={() => window.history.back()}
                    title="Title"
                    subTitle="This is a subtitle"
                    extra={[
                        <Button type="primary">
                            Primary
                        </Button>,
                    ]}
                />
            </Content>
        </div>
    );
}

export default Docs;
